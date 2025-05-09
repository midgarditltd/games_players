<?php

    use Illuminate\Support\Facades\Route;
    use midgarditltd\Games\Players\Http\Controllers\PlayerController;

    Route::prefix(config('games-players.routes.prefix', 'games'))
         ->middleware(config('games-players.routes.middleware', ['web', 'auth']))
         ->group(function () {
             Route::get('/players/{player}', [PlayerController::class, 'show'])
                  ->name(config('games-players.routes.show_route_name', 'games.players.show'));
         });
