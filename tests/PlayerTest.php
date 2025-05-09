<?php

    use midgarditltd\Games\Players\Player;

    it('can create a player model instance', function () {
        $player = new Player();

        expect($player)->toBeInstanceOf(Player::class);
    });

    it('uses the correct table name', function () {
        $player = new Player();

        expect($player->getTable())->toBe('games_players');
    });

    it('has the correct fillable attributes', function () {
        $player = new Player();
        $fillable = $player->getFillable();

        expect($fillable)->toContain('user_id')
                         ->toContain('nickname')
                         ->toContain('active')
                         ->toContain('options');
    });

    it('casts attributes correctly', function () {
        $player = new Player();
        $casts = $player->getCasts();

        expect($casts['user_id'])->toBe('integer')
                                 ->and($casts['nickname'])->toBe('string')
                                 ->and($casts['active'])->toBe('boolean')
                                 ->and($casts['options'])->toBe(\Illuminate\Database\Eloquent\Casts\AsArrayObject::class);
    });

    it('returns the correct validation rules', function () {
        $player = new Player();
        $rules = $player->validateRules();

        expect($rules)->toHaveKey('user_id')
                      ->toHaveKey('nickname')
                      ->toHaveKey('active')
                      ->toHaveKey('options');
    });

    it('provides accessors for active status', function () {
        $player = new Player();

        // Test inactive
        $player->active = false;
        expect($player->ActiveColour)->toBe('red')
                                     ->and($player->ActiveDescription)->toBe('Inactive');

        // Test active
        $player->active = true;
        expect($player->ActiveColour)->toBe('green')
                                     ->and($player->ActiveDescription)->toBe('Active');
    });
