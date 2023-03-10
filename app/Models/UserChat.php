<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string messageable_type
 * @property int id
 * @property int messageable_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon last_delivery
 * @property User|Group messageable
 */
class UserChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated_at',
        'user_id',
    ];

    protected $casts = [
        'last_delivery' => 'datetime',
    ];

    public function messageable(): MorphTo
    {
        return $this->morphTo();
    }
}
