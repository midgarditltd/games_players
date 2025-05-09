<?php

    namespace midgarditltd\Games\Players;

    use Illuminate\Database\Eloquent\Factories\Factory;

    class PlayerFactory extends Factory
    {
        protected $model = Player::class;

        public function definition()
        {
            $userModel = config('games-players.user_model', config('auth.providers.users.model', User::class));

            return [
                'user_id'  => $userModel::factory(),
                'nickname' => $this->faker->userName,
                'active'   => $this->faker->boolean,
                'options'  => NULL,
            ];
        }
    }
