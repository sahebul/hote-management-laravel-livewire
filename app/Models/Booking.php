<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'check_in',
        'check_out',
        'status',
        'total_amount',
        'staff_id'
    ];

    public function room()
    {
        return $this->hasMany(BookingRoom::class);
    }

    public function guest()
    {
        return $this->hasMany(BookingGuest::class);
    }

    public function primaryGuest()
    {
        return $this->hasOne(BookingGuest::class)->where('primary_guest', 1);
    }
}
