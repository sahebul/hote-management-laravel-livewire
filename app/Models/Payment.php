<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable=['booking_id','amount','payment_date','payment_mode'];

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id');
    }
}
