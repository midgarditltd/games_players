<?php

use midgarditltd\Games\Players\Player;
use function Pest\Laravel\get;

it('can access the player show route', function () {
    // Set up config to ensure the route is enabled
    config()->set('games-players.routes.enabled', true);
    config()->set('games-players.routes.middleware', ['web']); // Remove auth for testing
    
    $player = Player::factory()->create([
        'nickname' => 'RouteTestPlayer',
    ]);
    
    // Access the route
    $response = get(route('games.players.show', $player->id));
    
    $response->assertStatus(200)
        ->assertSee('RouteTestPlayer');
});