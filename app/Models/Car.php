<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'cars';
    protected $guarded = false;
    
    public function model()
    {
        return $this->belongsTo(ModelCar::class, 'model');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand');
    }
}
