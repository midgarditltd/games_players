<?php

namespace midgarditltd\Games\Players;

class GamesPlayers
{
    public function players()
    {
        return Player::all();
    }

    public function findPlayer($id)
    {
        return Player::findById($id);
    }
}
