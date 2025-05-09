<?php

use midgarditltd\Games\Players\Facades\GamesPlayers;

it('registers the games-players facade', function () {
    expect(app()->bound('games-players'))->toBeTrue();
});

it('provides config file with correct structure', function () {
    $config = config('games-players');
    
    expect($config)->toBeArray()
        ->toHaveKey('user_model')
        ->toHaveKey('routes');
    
    expect($config['routes'])->toBeArray()
        ->toHaveKey('enabled')
        ->toHaveKey('prefix')
        ->toHaveKey('middleware')
        ->toHaveKey('show_route_name');
});