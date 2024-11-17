<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3), // Nama ticket
            'status' => $this->faker->randomElement(['open', 'in_progress', 'closed']), // Status
            'user_id' => User::where('role', 'customer')->inRandomOrder()->first()->id, // Assign ke random customer
        ];
    }
}
