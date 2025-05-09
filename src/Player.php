<?php

    namespace midgarditltd\Games\Players;

    use Illuminate\Validation\Rule;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\Casts\AsArrayObject;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Player extends Model
    {
        use SoftDeletes;
        use HasFactory;

        public    $timestamps   = TRUE;
        protected $table        = 'games_players';
        public    $incrementing = TRUE;
        protected $fillable     = ['user_id', 'nickname', 'active', 'options',];
        protected $visible      = ['id', 'user_id', 'nickname', 'active', 'options',];
        protected $casts        = [
            'user_id'    => 'integer',
            'nickname'   => 'string',
            'active'     => 'boolean',
            'options'    => AsArrayObject::class,
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
            'deleted_at' => 'datetime:Y-m-d H:i:s',
        ];

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //VALIDATION
        public function validateRules(): array
        {
            return [
                'user_id'  => ['required', 'int', Rule::exists('users', 'id'), Rule::unique($this->table, 'user_id')->ignore($this->id)],
                'nickname' => ['required', 'string', Rule::unique($this->table, 'nickname')->ignore($this->id)],
                'active'   => ['nullable', 'sometimes'],
                'options'  => ['json', 'nullable', 'sometimes'],
            ];
        }

        public function validateMessages(): array
        {
            return ['nickname.required' => 'A Player Nickname is required.'];
        }

        protected static function newFactory(): PlayerFactory
        {
            return new PlayerFactory();
        }

        public function HeaderOptions()
        {
            return $this->visible;
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // RELATIONSHIPS
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function User(): BelongsTo
        {
            $userModel = config('games-players.user_model', config('auth.providers.users.model'));

            return $this->belongsTo($userModel);
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // SEARCH OPTIONS
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // APPLY TO ALL ON BOOT
        protected static function boot()
        {
            parent::boot();
            static::addGlobalScope('order', function ($builder) {
                $builder->orderBy('nickname', 'asc');
            });
        }

        public static function findById(int|string $player): mixed
        {
            return self::where('id', '=', $player)->firstOrFail();
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // SLUG : To allow fancy URL on Player
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /**
         * Get the URL for viewing this player.
         */
        public function url(): Attribute
        {
            return Attribute::make(
                get: fn() => route(config('games-players.routes.show_route_name', 'games.players.show'), $this->id)
            );
        }

        public function ActiveColour(): Attribute
        {
            return Attribute::make(get: fn() => $this->active ? 'green' : 'red');
        }

        public function ActiveDescription(): Attribute
        {
            return Attribute::make(get: fn() => $this->active ? 'Active' : 'Inactive');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
