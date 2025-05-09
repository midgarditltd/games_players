<?php

    namespace midgarditltd\Games\Players\Facades;

    use Illuminate\Support\Facades\Facade;
    use midgarditltd\Games\Players\GamesPlayers as GamesPlayersClass;

    class GamesPlayers extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return 'games-players';
        }
    }
