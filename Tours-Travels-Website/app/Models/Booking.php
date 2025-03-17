<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'contact_id', 'booking_date', 'booking_time', 'discount', 'total_price', 'status'];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
