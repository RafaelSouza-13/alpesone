<?php

namespace App\Servies;

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;

class VehicleService
{
    public static function mapper(array $item): array{
        return [
            'json_data_id' => $item['id'],
            'created' => $item['created'],
            'updated' => $item['updated'],
            'type'         => $item['type'],
            'brand'        => $item['brand'],
            'model'        => $item['model'],
            'version'      => $item['version'],
            'doors'        => $item['doors'],
            'board'        => $item['board'],
            'chassi'       => $item['chassi'],
            'transmission' => $item['transmission'],
            'km'           => $item['km'],
            'description'  => $item['description'],
            'sold'         => $item['sold'],
            'category'     => $item['category'],
            'url_car'      => $item['url_car'],
            'old_price'    => $item['old_price'],
            'price'        => $item['price'],
            'color'        => $item['color'],
            'fuel'         => $item['fuel'],
            'year'         => json_encode($item['year']),
            'optionals'    => json_encode($item['optionals']),
            'fotos'        => json_encode($item['fotos']),
        ];
    }
}
