<?php

namespace midgarditltd\Games\Players;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PlayersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('games-players')
            ->hasConfigFile()
            ->hasMigration('create_games_players_table');
    }
}
