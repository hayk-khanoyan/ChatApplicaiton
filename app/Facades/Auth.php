<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth as SupportAuth;

/**
 * @method static string login(Authenticatable|Model $user, bool $remember = false)
 * @method static string refresh(bool $forceForever = false,bool $resetClaims = false)
 */
class Auth extends SupportAuth
{
}
