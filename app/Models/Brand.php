<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    
    protected $table = 'brands';
    protected $connection = 'mysql';

    public function car()
    {
        return $this->belongsTo(Car::class, 'id');
    }
}
