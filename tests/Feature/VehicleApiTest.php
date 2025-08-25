<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleApiTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function vehicles_list_returns_paginated_data_5(){
        Vehicle::factory()->count(50)->create();

        $response = $this->getJson('/api/v1/vehicles?page=5');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data',
                    'links' => ['first', 'last', 'prev', 'next'],
                    'meta'  => ['current_page', 'last_page', 'per_page', 'total']
                ]);

        $this->assertEquals(5, $response->json('meta.current_page'));
    }

    /** @test */
    public function vehicles_return_by_id(){
        $vehicle = Vehicle::factory()->create();
        $response = $this->getJson("/api/v1/vehicles/{$vehicle->json_data_id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
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
                'fotos',
            ]
        ]);
        $this->assertEquals($vehicle->json_data_id, $response->json('data.json_data_id'));
    }

    /** @test */
    public function vehicles_can_be_created()
    {
        // Dados simulados para criar um veículo
        $data = [
            'json_data_id' => 12345,
            'type' => 'carro',
            'brand' => 'Hyundai',
            'model' => 'Creta',
            'version' => '2020',
            'doors' => 4,
            'board' => 'ABC',
            'chassi' => '1234567890',
            'transmission' => 'Automatic',
            'km' => '1200',
            'description' => 'Veículo de teste',
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => false,
            'category' => 'Sedan',
            'url_car' => 'https://example.com/car',
            'old_price' => null,
            'price' => 55000,
            'color' => 'Red',
            'fuel' => 'Gasoline',
            'year' => json_encode(['model' => '2023', 'build' => '2022']),
            'optionals' => json_encode(['Sunroof', 'GPS']),
            'fotos' => json_encode(['https://example.com/foto1.jpg']),
        ];

        $response = $this->postJson('/api/v1/vehicles', $data);

        $response->assertStatus(201);

        // Valida estrutura do JSON retornado (Resource)
        $response->assertJsonStructure([
            'data' => [
                'id',
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
                'fotos',
            ]
        ]);

        // Verifica se o registro realmente existe no banco
        $this->assertDatabaseHas('vehicles', [
            'json_data_id' => 12345,
            'brand' => 'Hyundai',
            'model' => 'Creta',
        ]);
    }
}
