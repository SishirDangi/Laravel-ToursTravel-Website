<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['package_name', 'package_description', 'package_type', 'package_price', 'status'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id');
    }
}
