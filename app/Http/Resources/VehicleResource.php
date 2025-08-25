<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'json_data_id' => $this->json_data_id,
            'type'         => $this->type,
            'brand'        => $this->brand,
            'model'        => $this->model,
            'version'      => $this->version,
            'doors'        => $this->doors,
            'board'        => $this->board,
            'chassi'       => $this->chassi,
            'transmission' => $this->transmission,
            'km'           => $this->km,
            'description'  => $this->description,
            'created'      => $this->created,
            'updated'      => $this->updated,
            'sold'         => $this->sold,
            'category'     => $this->category,
            'url_car'      => $this->url_car,
            'old_price'    => $this->old_price,
            'price'        => $this->price,
            'color'        => $this->color,
            'fuel'         => $this->fuel,
            'year'         => $this->year,
            'optionals'    => $this->optionals,
            'fotos'        => $this->fotos,
        ];
    }
}
