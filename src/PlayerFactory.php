<?php

namespace midgarditltd\Games\Players;

use Illuminate\Database\Eloquent\Factories\Factory;
use midgarditltd\Games\Players\Tests\TestModels\User; // Keep this for type hinting if needed

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        // Get user model from config, but we won't use its factory here
        $userModel = config('games-players.user_model', User::class); // Keep for potential future use if you decide to test relations later

        return [
            'user_id' => $this->faker->randomNumber(), // Assign a random integer as user_id
            'nickname' => $this->faker->userName(),
            'active' => $this->faker->boolean(),
            'options' => null,
        ];
    }
}
