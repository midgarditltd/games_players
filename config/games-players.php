<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default User Model
    |--------------------------------------------------------------------------
    |
    | This option controls the user model that will be related to players.
    | By default, it uses the Laravel authentication config.
    |
    */
    'user_model' => config('auth.providers.users.model', \App\Models\User::class),

    /*
    |--------------------------------------------------------------------------
    | Player Routes
    |--------------------------------------------------------------------------
    |
    | Configuration for player related routes
    |
    */
    'routes' => [
        'enabled' => true,
        'prefix' => 'games',
        'middleware' => ['web', 'auth'],
        'show_route_name' => 'games.players.show',
    ],
];
