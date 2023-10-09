<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class CoordinateCar extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    
    protected $collection  = 'coordinate_cars';
    protected $fillable = ['vin','latitude','longitude'];
}
