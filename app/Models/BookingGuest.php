<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  BookingGuest  extends Model
{
    use SoftDeletes;  
    protected $fillable = ['booking_id', 'guest_id','primary_guest'];

    public function guestDetail()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
