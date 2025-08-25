<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    public $timestamps = false;
    protected $fillable = [
        'json_data_id',
        'type',
        'brand',
        'model',
        'version',
        'doors',
        'board',
        'chassi',
        'transmission',
        'km',
        'description',
        'created',
        'updated',
        'sold',
        'category',
        'url_car',
        'old_price',
        'price',
        'color',
        'fuel',
        'year',
        'optionals',
        'fotos'
    ];
}
