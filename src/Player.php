<?php

namespace midgarditltd\Games\Players;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'games_players';

    protected $fillable = [
        'user_id',
        'nickname',
        'active',
        'options',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'nickname' => 'string',
        'active' => 'boolean',
        'options' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the player.
     */
    public function user(): BelongsTo
    {
        $userModel = config('games-players.user_model', config('auth.providers.users.model'));

        return $this->belongsTo($userModel);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return \Database\Factories\PlayerFactory::new();
    }
}
