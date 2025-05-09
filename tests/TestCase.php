<?php

    namespace midgarditltd\Games\Players\Tests;

    use midgarditltd\Games\Players\PlayersServiceProvider;
    use Orchestra\Testbench\TestCase as Orchestra;

    class TestCase extends Orchestra
    {
        protected function setUp(): void
        {
            parent::setUp();

            // Create games_players table
            $this->createGamesPlayersTable();

            // Disable foreign key checks to allow creating players without users
            $this->app['db']->connection()->getSchemaBuilder()->disableForeignKeyConstraints();
        }

        protected function getPackageProviders($app)
        {
            return [
                PlayersServiceProvider::class,
            ];
        }

        public function getEnvironmentSetUp($app)
        {
            config()->set('database.default', 'testing');
            config()->set('app.key', 'base64:'.base64_encode(\Illuminate\Support\Str::random(32)));
            config()->set('games-players.routes.middleware', ['web']);

        }

        protected function createGamesPlayersTable(): void
        {
            // Include your migration file
            $migration = include __DIR__.'/../database/migrations/create_games_players_table.php';
            $migration->up();
        }
    }
