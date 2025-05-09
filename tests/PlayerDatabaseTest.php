<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use midgarditltd\Games\Players\Player;

uses(RefreshDatabase::class);

// Remove the beforeEach with User creation

it('can create a player in the database', function () {
    $player = Player::create([
        'user_id' => 1, // Just use a hardcoded ID
        'nickname' => 'TestPlayer1',
        'active' => true,
        'options' => ['level' => 1, 'points' => 0],
    ]);

    expect($player->exists)->toBeTrue()
        ->and($player->nickname)->toBe('TestPlayer1')
        ->and($player->active)->toBeTrue()
        ->and($player->options->toArray())->toBe(['level' => 1, 'points' => 0]);

    // Also check DB persistence
    $this->assertDatabaseHas('games_players', [
        'id' => $player->id,
        'nickname' => 'TestPlayer1',
    ]);
});

it('can find a player by id', function () {
    $created = Player::create([
        'user_id' => 1, // Just use a hardcoded ID
        'nickname' => 'TestPlayer2',
        'active' => true,
    ]);

    $found = Player::findById($created->id);

    expect($found->id)->toBe($created->id)
        ->and($found->nickname)->toBe('TestPlayer2');
});

it('enforces unique nickname constraint', function () {
    Player::create([
        'user_id' => 1,
        'nickname' => 'UniqueNickname',
        'active' => true,
    ]);

    // This should throw an exception because nickname must be unique
    Player::create([
        'user_id' => 2,
        'nickname' => 'UniqueNickname',
        'active' => false,
    ]);
})->throws(\Illuminate\Database\QueryException::class);

it('uses soft deletes', function () {
    $player = Player::create([
        'user_id' => 1,
        'nickname' => 'SoftDeleteTest',
        'active' => true,
    ]);

    $playerId = $player->id;
    $player->delete();

    // Should not find it with regular query
    expect(Player::find($playerId))->toBeNull();

    // Should find it when including trashed
    $trashedPlayer = Player::withTrashed()->find($playerId);
    expect($trashedPlayer)->not->toBeNull()
        ->and($trashedPlayer->nickname)->toBe('SoftDeleteTest')
        ->and($trashedPlayer->deleted_at)->not->toBeNull();
});
