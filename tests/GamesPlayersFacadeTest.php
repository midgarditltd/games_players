<?php

    use midgarditltd\Games\Players\Facades\GamesPlayers;
    use midgarditltd\Games\Players\Player;

    it('can get all players through the facade', function () {
        // Create some players for testing without factories
        Player::create([
                           'user_id' => 1,
                           'nickname' => 'TestFacadePlayer1',
                           'active' => true,
                       ]);

        Player::create([
                           'user_id' => 2,
                           'nickname' => 'TestFacadePlayer2',
                           'active' => false,
                       ]);

        Player::create([
                           'user_id' => 3,
                           'nickname' => 'TestFacadePlayer3',
                           'active' => true,
                       ]);

        $players = GamesPlayers::players();

        expect($players)->toBeCollection()
                        ->and($players->count())->toBeGreaterThanOrEqual(3);
    });

    it('can find a specific player through the facade', function () {
        $createdPlayer = Player::create([
                                            'user_id' => 4,
                                            'nickname' => 'FacadeTestPlayer',
                                            'active' => true,
                                        ]);

        $player = GamesPlayers::findPlayer($createdPlayer->id);

        expect($player)->toBeInstanceOf(Player::class)
                       ->and($player->id)->toBe($createdPlayer->id)
                       ->and($player->nickname)->toBe('FacadeTestPlayer');
    });
