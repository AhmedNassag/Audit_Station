<?php

namespace App\Models;

use App\Models\Builders\UserBuilder;
use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Traits\HasVerifyTokens;
use Modules\Auth\Traits\UserRelations;
use Modules\Role\Traits\HasPermissions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens,
        HasFactory,
        HasPermissions,
        HasVerifyTokens,
        InteractsWithMedia,
        Notifiable,
        PaginationTrait,
        Searchable,
        UserRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'type',
        'email_verified_at',
        'reached_company',
        'reached_interviewer',
        'reached_certified',
        'reached_accountant',
        'reached_instructor',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
            'reached_company' => 'boolean',
            'reached_interviewer' => 'boolean',
            'reached_certified' => 'boolean',
            'reached_accountant' => 'boolean',
            'reached_instructor' => 'boolean',
        ];
    }

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }

    public function resetAvatar(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function routeNotificationForFcm(): ?string
    {
        return $this->fcm_token;
    }
}
