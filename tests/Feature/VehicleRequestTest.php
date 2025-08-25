<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\VehicleRequest;

class VehicleRequestTest extends TestCase
{
    protected VehicleRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new VehicleRequest();
    }
    public function test_validation_passes_with_valid_data()
    {
        $data = [
            'id' => 1,
            'type' => 'carro',
            'brand' => 'Hyundai',
            'model' => 'Creta',
            'version' => '2020',
            'doors' => '4',
            'board' => 'ABC',
            'chassi' => '123',
            'transmission' => 'Automatic',
            'km' => '1200',
            'description' => 'Test car',
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => false,
            'category' => 'Sedan',
            'url_car' => 'https://example.com/car',
            'old_price' => null,
            'price' => 55000,
            'color' => 'Red',
            'fuel' => 'Gasoline',
            'year'       => ['model' => '2023', 'build' => '2022'],
            'optionals'  => ['Sunroof', 'GPS'],
            'fotos'      => ['https://example.com/foto1.jpg'],
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_validation_fails_with_id_null()
    {
        $data = [
            'id' => null,
            'type' => 'carro',
            'brand' => 'Hyundai',
            'model' => 'Creta',
            'version' => '2020',
            'doors' => 4,
            'board' => 'ABC',
            'chassi' => '123',
            'transmission' => 'Automatic',
            'km' => '1200',
            'description' => 'Test car',
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => false,
            'category' => 'Sedan',
            'url_car' => 'https://example.com/car',
            'old_price' => null,
            'price' => 55000,
            'color' => 'Red',
            'fuel' => 'Gasoline',
            'year'       => ['model' => '2023', 'build' => '2022'],
            'optionals'  => ['Sunroof', 'GPS'],
            'fotos'      => ['https://example.com/foto1.jpg'],
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('id', $validator->errors()->toArray());
    }

    public function test_validation_fails_with_id_string()
    {
        $data = [
            'id' => 'xxxxx',
            'type' => 'carro',
            'brand' => 'Hyundai',
            'model' => 'Creta',
            'version' => '2020',
            'doors' => 4,
            'board' => 'ABC',
            'chassi' => '123',
            'transmission' => 'Automatic',
            'km' => '1200',
            'description' => 'Test car',
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => false,
            'category' => 'Sedan',
            'url_car' => 'https://example.com/car',
            'old_price' => null,
            'price' => 55000,
            'color' => 'Red',
            'fuel' => 'Gasoline',
            'year'       => json_encode(['model' => '2023', 'build' => '2022']),
            'optionals'  => json_encode(['Sunroof', 'GPS']),
            'fotos'      => json_encode(['https://example.com/foto1.jpg']),
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('id', $validator->errors()->toArray());
    }

    public function test_validation_fails_with_price_is_negative()
    {
        $data = [
            'id' => 'xxxxx',
            'type' => 'carro',
            'brand' => 'Hyundai',
            'model' => 'Creta',
            'version' => '2020',
            'doors' => 4,
            'board' => 'ABC',
            'chassi' => '123',
            'transmission' => 'Automatic',
            'km' => '1200',
            'description' => 'Test car',
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => false,
            'category' => 'Sedan',
            'url_car' => 'https://example.com/car',
            'old_price' => null,
            'price' => -55000,
            'color' => 'Red',
            'fuel' => 'Gasoline',
            'year'       => json_encode(['model' => '2023', 'build' => '2022']),
            'optionals'  => json_encode(['Sunroof', 'GPS']),
            'fotos'      => json_encode(['https://example.com/foto1.jpg']),
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('price', $validator->errors()->toArray());
    }

    public function test_validation_fails_with_doors_less_than_two()
    {
        $data = [
            'id' => 'xxxxx',
            'type' => 'carro',
            'brand' => 'Hyundai',
            'model' => 'Creta',
            'version' => '2020',
            'doors' => 1,
            'board' => 'ABC',
            'chassi' => '123',
            'transmission' => 'Automatic',
            'km' => '1200',
            'description' => 'Test car',
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => false,
            'category' => 'Sedan',
            'url_car' => 'https://example.com/car',
            'old_price' => null,
            'price' => 55000,
            'color' => 'Red',
            'fuel' => 'Gasoline',
            'year'       => json_encode(['model' => '2023', 'build' => '2022']),
            'optionals'  => json_encode(['Sunroof', 'GPS']),
            'fotos'      => json_encode(['https://example.com/foto1.jpg']),
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('doors', $validator->errors()->toArray());
    }
}
