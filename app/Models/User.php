<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as ModelUser;
class User extends ModelUser
{
    //
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(UsersPermission::class);
    }
}
