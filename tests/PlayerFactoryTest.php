<?php

    use midgarditltd\Games\Players\Player;

    it('can create a player using the factory', function () {
        $player = Player::factory()->create();

        expect($player)->toBeInstanceOf(Player::class)
                       ->and($player->exists)->toBeTrue()
                       ->and($player->nickname)->not->toBeEmpty()
                                                    ->and($player->user_id)->toBeNumeric();
    });

    it('can create a player with custom attributes', function () {
        $player = Player::factory()->create([
                                                'nickname' => 'CustomFactoryPlayer',
                                                'active' => false,
                                            ]);

        expect($player->nickname)->toBe('CustomFactoryPlayer')
                                 ->and($player->active)->toBeFalse();
    });

    it('can create multiple players', function () {
        $players = Player::factory()->count(3)->create();

        expect($players)->toHaveCount(3)
                        ->and($players->first())->toBeInstanceOf(Player::class);
    });
