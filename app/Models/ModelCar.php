<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
    use HasFactory;
    protected $table = 'model_cars';
    protected $connection = 'mysql';

     public function car()
    {
        return $this->belongsTo(Car::class, 'id');
    }
}
