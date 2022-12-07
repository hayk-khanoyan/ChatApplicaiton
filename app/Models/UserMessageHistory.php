<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class UserMessageHistory extends Model
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
