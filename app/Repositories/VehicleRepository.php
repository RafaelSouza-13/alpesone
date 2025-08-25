<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;

class VehicleRepository
{
    public function updateOrCreate(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return Vehicle::updateOrCreate(
                    ['json_data_id' => $data['json_data_id']],
                    [
                        'type'         => $data['type'],
                        'brand'        => $data['brand'],
                        'model'        => $data['model'],
                        'version'      => $data['version'],
                        'doors'        => $data['doors'],
                        'board'        => $data['board'],
                        'chassi'       => $data['chassi'],
                        'transmission' => $data['transmission'],
                        'km'           => $data['km'],
                        'description'  => $data['description'],
                        'created' => $data['created'],
                        'updated' => $data['updated'],
                        'sold'         => $data['sold'],
                        'category'     => $data['category'],
                        'url_car'      => $data['url_car'],
                        'old_price'    => $data['old_price'],
                        'price'        => $data['price'],
                        'color'        => $data['color'],
                        'fuel'         => $data['fuel'],
                        'year'         => json_encode($data['year']),
                        'optionals'    => json_encode($data['optionals']),
                        'fotos'        => json_encode($data['fotos']),
                    ]
                );
            }, 3);
        } catch (QueryException $qe) {
            report($qe);
            logger()->error("Erro de Query no VehicleRepository: " . $qe->getMessage(), ['id' => $data['id']]);
            return null;
        } catch (\Throwable $e) {
            report($e);
            logger()->error("Erro inesperado no VehicleRepository: " . $e->getMessage(), ['id' => $data['id']]);
            return null;
        }
    }
}
