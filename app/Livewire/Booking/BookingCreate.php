<?php
namespace App\Livewire\Booking;
use App\Models\BookingGuest;
use App\Models\BookingRoom;
use App\Models\Guest;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use livewire\Component;
use App\Models\Booking;

class BookingCreate extends Component
{
    public $form = [];
    public $editId = null;

    public $guests; // All guests for dropdown
    public $selectedGuestId;
    public $selectedGuests = [];
    public $rooms; // All rooms for dropdown
    public $selectedRoomId;
    public $selectedRooms = [];

    public function render()
    {

        $this->guests = Guest::all();
        $this->rooms = Room::all(); //select('*')->where('status', 'available')->get();
        // dd($rooms);
        return view('livewire.booking.booking-create', [
            'guests' => $this->guests,
            'rooms' => $this->rooms
        ])->layout('layouts.app');
    }


    public function mount($id = null)
    {
        //The mount() method runs automatically when the component is initialized/rendered.
        //it handle the edit functionality 
        if ($id) {
            $this->editId = $id;
            $booking = Booking::findOrFail($id);
            $this->form = $booking->toArray();
            $this->selectedGuests = $booking->guest->map(function ($guest) {
                return [
                    'id' => $guest->guest_id,
                    'name' => $guest->guestDetail->name,
                    'primary_guest' => $guest->primary_guest ? true : false
                ];
            })->toArray();

            $this->selectedRooms = $booking->room->map(function ($room) {
                return [
                    'id' => $room->room_id,
                    'number' => $room->roomDetail->room_number,
                    'price' => $room->price
                ];
            })->toArray();
        }
    }


    public function save()
    {
        $this->validate([
            'form.check_in' => 'required|date',
            'form.check_out' => 'required|date|after:form.check_in',
            'form.status' => 'required',
            'form.total_amount' => 'required|numeric',
        ]);
        if ($this->editId) {
            DB::beginTransaction();
            try {
                $booking = Booking::find($this->editId);
                $booking->update($this->form);

                //delete existing guests and rooms
                BookingGuest::where('booking_id', $booking->id)->delete();
                BookingRoom::where('booking_id', $booking->id)->delete();

                //re-insert guests

                $guestList = [];
                foreach ($this->selectedGuests as $guest) {
                    $guestList[] = array(
                        'booking_id' => $booking->id,
                        'guest_id' => $guest['id'],
                        // 'primary_guest' => $guest['id'] == $this->form['primary_guest_id'] ? 1 : 0
                        'primary_guest' => isset($guest['primary_guest']) && $guest['primary_guest'] ? 1 : 0
                    );
                }
                BookingGuest::insert($guestList);
                $roomList = [];
                foreach ($this->selectedRooms as $room) {
                    $roomList[] = array(
                        'booking_id' => $booking->id,
                        'room_id' => $room['id'],
                        'price' => $room['price']
                    );
                }
                BookingRoom::insert($roomList);


                //here we update the guests and rooms
                $this->dispatch('show-toast', message: 'Booking Updated Successfully');
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                $this->dispatch('show-toast', message: 'Error: ' . $exception->getMessage());
                return;
            }

        } else {

            DB::beginTransaction();
            try {

                $this->form['staff_id'] = auth()->id(); // Uncomment if you want to save the user_id
                $this->form['booking_ref'] = 'BK-' . time(); // Generate a unique booking reference
                $booking = Booking::create($this->form);
                $bookingId = $booking->id;
                $booking->booking_ref = 'BOOK-' . Carbon::now()->format('Ymd') . '-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT);
                $booking->save();

                


                $guestList = [];
                foreach ($this->selectedGuests as $guest) {
                    $guestList[] = array(
                        'booking_id' => $bookingId,
                        'guest_id' => $guest['id'],
                        // 'primary_guest' => $guest['id'] == $this->form['primary_guest_id'] ? 1 : 0
                         'primary_guest' => isset($guest['primary_guest']) && $guest['primary_guest'] ? 1 : 0
                    );
                }
                BookingGuest::insert($guestList);
                $roomList = [];
                foreach ($this->selectedRooms as $room) {
                    $roomList[] = array(
                        'booking_id' => $bookingId,
                        'room_id' => $room['id'],
                        'price' => $room['price']
                    );
                }
                BookingRoom::insert($roomList);


                $this->dispatch('show-toast', message: 'Booking Added Successfully');
                DB::commit();
                $this->reset(['form', 'selectedGuests', 'selectedRooms', 'selectedGuestId', 'selectedRoomId']);

            } catch (\Exception $exception) {
                DB::rollBack();
                $this->dispatch('show-toast', message: 'Error: ' . $exception->getMessage());
                return;

            }


        }
        return redirect()->route('bookings.list');
    }

    public function addGuest()
    {
        if ($this->selectedGuestId && !in_array($this->selectedGuestId, array_column($this->selectedGuests, 'id'))) {
            $guest = Guest::find($this->selectedGuestId);
            if ($guest) {
                $this->selectedGuests[] = [
                    'id' => $guest->id,
                    'name' => $guest->name
                ];
            }
        }
        $this->selectedGuestId = null; // reset dropdown
    }
    public function removeGuest($id)
    {
        $this->selectedGuests = array_filter($this->selectedGuests, fn($g) => $g['id'] !== $id);
    }

    public function primaryGuest($id)
    {
        // Set the primary guest
        foreach ($this->selectedGuests as &$guest) {
            $guest['primary_guest'] = $guest['id'] === $id ? true : false;
        }
        $this->dispatch('show-toast', message: 'Primary Guest Updated');
    }
    public function addRoom()
    {
        if ($this->selectedRoomId && !in_array($this->selectedRoomId, array_column($this->selectedRooms, 'id'))) {
            $room = Room::find($this->selectedRoomId);
            if ($room) {
                $this->selectedRooms[] = [
                    'id' => $room->id,
                    'number' => $room->room_number,
                    'price' => $room->roomType->price
                ];
            }
        }
        $this->selectedRoomId = null; // reset dropdown
    }
    public function removeRoom($id)
    {
        $this->selectedRooms = array_filter($this->selectedRooms, fn($r) => $r['id'] !== $id);
    }


}