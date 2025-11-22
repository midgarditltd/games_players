<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | The user model that will be related to players.
    | By default, it uses Laravel's authentication config.
    |
    */
    'user_model' => config('auth.providers.users.model', \App\Models\User::class),
];
