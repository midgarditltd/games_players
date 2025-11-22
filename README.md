# Games Players - Base Player Tracking for Laravel Games

[![Latest Version on Packagist](https://img.shields.io/packagist/v/midgarditltd/games-players.svg?style=flat-square)](https://packagist.org/packages/midgarditltd/games-players)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/midgarditltd/games-players/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/midgarditltd/games-players/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/midgarditltd/games-players/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/midgarditltd/games-players/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/midgarditltd/games-players.svg?style=flat-square)](https://packagist.org/packages/midgarditltd/games-players)

A simple, lightweight Laravel package that provides a base Player model and migration for game packages. This package is designed to be included by other game packages as the main way to track players and their games.

## Features

- **Simple Player Model** - Clean Eloquent model with essential fields
- **User Relationship** - Built-in relationship to your User model
- **Soft Deletes** - Players are soft deleted by default
- **Flexible Options** - JSON field for storing game-specific data
- **Factory Support** - Includes factory for testing
- **Configurable** - Easy configuration for custom user models

## Installation

Install the package via Composer:

```bash
composer require midgarditltd/games-players
```

Publish and run the migrations:

```bash
php artisan vendor:publish --tag="games-players-migrations"
php artisan migrate
```

Optionally, publish the config file:

```bash
php artisan vendor:publish --tag="games-players-config"
```

## Usage

### Basic Usage

The package provides a `Player` model that you can use directly or extend in your game packages:

```php
use midgarditltd\Games\Players\Player;

// Create a new player
$player = Player::create([
    'user_id' => auth()->id(),
    'nickname' => 'GameMaster',
    'active' => true,
    'options' => ['level' => 1, 'score' => 0]
]);

// Get a player's user
$user = $player->user;

// Find players
$activePlayers = Player::where('active', true)->get();
$player = Player::find($id);
```

### Extending the Player Model

Your game packages can extend the Player model to add game-specific functionality:

```php
namespace YourVendor\YourGame;

use midgarditltd\Games\Players\Player as BasePlayer;

class ChessPlayer extends BasePlayer
{
    public function getRatingAttribute()
    {
        return $this->options['rating'] ?? 1200;
    }

    public function games()
    {
        return $this->hasMany(ChessGame::class);
    }
}
```

### Player Fields

The `games_players` table includes:

- `id` - Auto-incrementing primary key
- `user_id` - Foreign key to users table
- `nickname` - Unique player nickname
- `active` - Boolean status (default: true)
- `options` - JSON field for game-specific data
- `created_at` / `updated_at` - Timestamps
- `deleted_at` - Soft delete timestamp

### Configuration

The config file allows you to customize the user model:

```php
return [
    'user_model' => \App\Models\User::class,
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Kristian Williams](https://github.com/midgarditltd)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
