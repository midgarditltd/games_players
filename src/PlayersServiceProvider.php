<?php

namespace midgarditltd\Games\Players;

use midgarditltd\Games\Players\Commands\PlayersCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PlayersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('games-players')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_games_players_table')
            ->hasCommand(PlayersCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->bind('games-players', function () {
            return new GamesPlayers;
        });
    }

    public function packageBooted(): void
    {
        // Register routes if enabled in config
        if (config('games-players.routes.enabled', true)) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }
    }
}
