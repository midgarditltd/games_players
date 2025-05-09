<?php

namespace midgarditltd\Games\Players\Commands;

use Illuminate\Console\Command;

class PlayersCommand extends Command
{
    public $signature = 'games-players';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
