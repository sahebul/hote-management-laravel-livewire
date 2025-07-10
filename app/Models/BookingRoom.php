<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  BookingRoom  extends Model
{
    use SoftDeletes;  
    protected $fillable = ['booking_id', 'room_id', 'price'];

    public function roomDetail()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
