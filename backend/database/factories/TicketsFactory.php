<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ["name" => "Technology", "id" => 101],
            ["name" => "Healthcare", "id" => 102],
            ["name" => "Finance", "id" => 103],
            ["name" => "Education", "id" => 104],
            ["name" => "Environment", "id" => 105],
            ["name" => "Retail", "id" => 106],
            ["name" => "Entertainment", "id" => 107],
            ["name" => "Manufacturing", "id" => 108],
            ["name" => "Food & Beverage", "id" => 109],
            ["name" => "Travel & Tourism", "id" => 110]
        ];
        $statuses = [
            ["id" => 1, "name" => "open"],
            ["id" => 4, "name" => "hold"],
            ["id" => 2, "name" => "on Process"],
            ["id" => 3, "name" => "success"]
        ];
        $companies = [
            ["name" => "TechNova Solutions", "id" => 84751],
            ["name" => "GreenWave Industries", "id" => 23549],
            ["name" => "EcoSmart Enterprises", "id" => 49328],
            ["name" => "FutureLink Innovations", "id" => 97261],
            ["name" => "Quantum Systems LLC", "id" => 12567],
            ["name" => "Visionary Holdings", "id" => 38745],
            ["name" => "Blue Horizon Technologies", "id" => 73690],
            ["name" => "Pinnacle Development Corp.", "id" => 84903],
            ["name" => "CoreX Solutions", "id" => 24581],
            ["name" => "InfiniteEdge Global", "id" => 60327]
        ];
        $services = [
            ["name" => "Express Delivery", "id" => 3001],
            ["name" => "Cargo Shipping", "id" => 3002],
            ["name" => "Passenger Transport", "id" => 3003],
            ["name" => "Freight Forwarding", "id" => 3004],
            ["name" => "Logistics Solutions", "id" => 3005],
            ["name" => "Global Distribution", "id" => 3006],
            ["name" => "Container Services", "id" => 3007],
            ["name" => "Bulk Shipping", "id" => 3008],
            ["name" => "International Routes", "id" => 3009],
            ["name" => "Port Operations", "id" => 3010]
        ];
        $names = [
            ["name" => "Liam Stewart", "id" => 1001],
            ["name" => "Sophia Roberts", "id" => 1002],
            ["name" => "Noah Harris", "id" => 1003],
            ["name" => "Emma Clark", "id" => 1004],
            ["name" => "Oliver Davis", "id" => 1005],
            ["name" => "Isabella Martinez", "id" => 1006],
            ["name" => "James Walker", "id" => 1007],
            ["name" => "Charlotte Lee", "id" => 1008],
            ["name" => "Mason Perez", "id" => 1009],
            ["name" => "Amelia White", "id" => 1010]
        ];
        $ships = [
            ["name" => "Sea Voyager", "id" => 2001],
            ["name" => "Oceanic Explorer", "id" => 2002],
            ["name" => "Atlantic Breeze", "id" => 2003],
            ["name" => "Sunset Sailor", "id" => 2004],
            ["name" => "Midnight Mariner", "id" => 2005],
            ["name" => "Crystal Wave", "id" => 2006],
            ["name" => "Aqua Dreamer", "id" => 2007],
            ["name" => "Deep Sea Hunter", "id" => 2008],
            ["name" => "Stormbreaker", "id" => 2009],
            ["name" => "Titanic Voyager", "id" => 2010]
        ];

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'contact_email' => $this->faker->email,
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High']),
            'organization' => $this->faker->randomElement(array_column($companies, 'name')),
            'vessel' => $this->faker->randomElement(array_column($ships, 'name')),
            'service_line' =>  $this->faker->randomElement(array_column($services, 'name')),
            'assign_to' => $this->faker->randomElement(array_column($names, 'name')),
            'status' => $this->faker->randomElement(array_column($statuses, 'name')),
            'category' => $this->faker->randomElement(array_column($categories, 'name')),
        ];
    }
}
