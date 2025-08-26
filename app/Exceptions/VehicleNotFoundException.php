<?php

namespace App\Exceptions;

use Exception;

class VehicleNotFoundException extends Exception
{
    public function report(){

    }
    public function render($request){
        return response()->json(
            ['error' => 'Veículo não encontrado'],
            404);
    }
}
