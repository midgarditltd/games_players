<?php

use midgarditltd\Games\Players\Player;

it('can create a player model instance', function () {
    $player = new Player;

    expect($player)->toBeInstanceOf(Player::class);
});

it('uses the correct table name', function () {
    $player = new Player;

    expect($player->getTable())->toBe('games_players');
});

it('has the correct fillable attributes', function () {
    $player = new Player;
    $fillable = $player->getFillable();

    expect($fillable)->toContain('user_id')
        ->toContain('nickname')
        ->toContain('active')
        ->toContain('options');
});

it('casts attributes correctly', function () {
    $player = new Player;
    $casts = $player->getCasts();

    expect($casts['user_id'])->toBe('integer')
        ->and($casts['nickname'])->toBe('string')
        ->and($casts['active'])->toBe('boolean')
        ->and($casts['options'])->toBe('array');
});
