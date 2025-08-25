<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'type' => $this->faker->randomElement(['carro', 'moto', 'caminhão']),
            'brand' => $this->faker->randomElement(['Hyundai', 'Toyota', 'Ford', 'Honda']),
            'model' => $this->faker->word(),
            'version' => $this->faker->year(),
            'doors' => $this->faker->numberBetween(2, 5),
            'board' => strtoupper($this->faker->bothify('???-####')),
            'chassi' => strtoupper($this->faker->bothify('??######??######')),
            'transmission' => $this->faker->randomElement(['Automatic', 'Manual']),
            'km' => $this->faker->numberBetween(0, 200000),
            'description' => $this->faker->sentence(),
            'created' => now()->toDateTimeString(),
            'updated' => now()->toDateTimeString(),
            'sold' => $this->faker->boolean(),
            'category' => $this->faker->randomElement(['Sedan', 'SUV', 'Hatch']),
            'url_car' => $this->faker->url(),
            'old_price' => $this->faker->optional()->randomFloat(2, 10000, 80000),
            'price' => $this->faker->randomFloat(2, 10000, 80000),
            'color' => $this->faker->safeColorName(),
            'fuel' => $this->faker->randomElement(['Gasoline', 'Ethanol', 'Diesel', 'Hybrid']),
            'year' => json_encode([
                'model' => $this->faker->year(),
                'build' => $this->faker->year()
            ]),
            'optionals' => json_encode($this->faker->randomElements(
                ['Sunroof', 'GPS', 'Airbag', 'ABS', 'Camera'], 
                $this->faker->numberBetween(1, 3)
            )),
            'fotos' => json_encode([
                $this->faker->imageUrl(640, 480, 'cars', true)
            ]),
        ];
    }
}
