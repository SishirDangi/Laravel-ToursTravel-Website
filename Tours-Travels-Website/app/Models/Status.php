<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['status_name'];

    public function packages()
    {
        return $this->hasMany(Package::class, 'status');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'status');
    }
}
