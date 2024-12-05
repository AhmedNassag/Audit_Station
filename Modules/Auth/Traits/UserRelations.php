<?php

namespace Modules\Auth\Traits;

use App\Helpers\MediaHelper;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Accountant\Models\Accountant;
use Modules\Auth\Enums\AuthEnum;
use Modules\Company\Models\Company;
use Modules\Instructor\Models\Instructor;
use Modules\Role\Models\Role;

trait UserRelations
{
    public function avatar()
    {
        return MediaHelper::mediaRelationship($this, AuthEnum::AVATAR_COLLECTION_NAME);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function instructor(): HasOne
    {
        return $this->hasOne(Instructor::class);
    }

    public function accountant(): HasOne
    {
        return $this->hasOne(Accountant::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissionsOnly(): BelongsToMany
    {
        return $this->roles();
    }
}
