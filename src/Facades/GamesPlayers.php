<?php

namespace midgarditltd\Games\Players\Facades;

use Illuminate\Support\Facades\Facade;

class GamesPlayers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'games-players';
    }
}
