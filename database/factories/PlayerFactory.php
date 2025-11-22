<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use midgarditltd\Games\Players\Player;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        $userModel = config('games-players.user_model', config('auth.providers.users.model'));

        return [
            'user_id' => $userModel::factory(),
            'nickname' => $this->faker->userName(),
            'active' => $this->faker->boolean(),
            'options' => null,
        ];
    }
}
