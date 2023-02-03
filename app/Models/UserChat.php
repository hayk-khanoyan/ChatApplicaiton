<?php

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
 * @property User|Group messageable
 */
class UserChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated_at',
        'user_id',
    ];

    public function messageable(): MorphTo
    {
        return $this->morphTo();
    }
}
