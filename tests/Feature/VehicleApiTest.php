<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
class VehicleApiTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria e autentica um usuário para todos os testes
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }
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
        $data = [
            'id' => 12345,
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
            'year' => ['model' => '2023', 'build' => '2022'],
            'optionals' => ['Sunroof', 'GPS'],
            'fotos' => ['https://example.com/foto1.jpg'],
        ];

        $response = $this->postJson('/api/v1/vehicles', $data);

        $response->assertStatus(201);
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

        $this->assertDatabaseHas('vehicles', [
            'json_data_id' => 12345,
            'brand' => 'Hyundai',
            'model' => 'Creta',
        ]);
    }

    /** @test */
    public function vehicles_can_be_updated(){
        $vehicle = Vehicle::factory()->create();

        $data = [
            'id' => $vehicle->json_data_id,
            'type' => 'carro',
            'brand' => 'Hyundai',
            'model' => 'Creta',
            'version' => '2020',
            'doors' => 4,
            'board' => 'ABC',
            'chassi' => '1234567890',
            'transmission' => 'Automatic',
            'km' => '2800',
            'description' => 'Veículo de teste',
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => false,
            'category' => 'Sedan',
            'url_car' => 'https://example.com/car',
            'old_price' => null,
            'price' => 45000,
            'color' => 'Blue',
            'fuel' => 'Gasoline',
            'year' => ['model' => '2023', 'build' => '2022'],
            'optionals' => ['Sunroof', 'GPS'],
            'fotos' => ['https://example.com/foto1.jpg'],
        ];

        $response = $this->putJson("/api/v1/vehicles/{$vehicle->json_data_id}", $data);

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

        $this->assertDatabaseHas('vehicles', [
            'json_data_id' => $vehicle->json_data_id,
            'brand' => 'Hyundai',
            'model' => 'Creta',
        ]);
    }
    /** @test */
    public function vehicles_can_be_deleted(){
        $vehicle = Vehicle::factory()->create();

        $response = $this->deleteJson("/api/v1/vehicles/{$vehicle->json_data_id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Vehicle deleted successfully.'
        ]);

        $this->assertDatabaseMissing('vehicles', [
            'json_data_id' => $vehicle->json_data_id,
        ]);
    }
}
