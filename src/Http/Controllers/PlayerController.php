<?php

namespace midgarditltd\Games\Players\Http\Controllers;

use Illuminate\Routing\Controller;
use midgarditltd\Games\Players\Player;

class PlayerController extends Controller
{
    public function show(Player $player)
    {
        return view('games-players::player', ['player' => $player]);
    }
}
