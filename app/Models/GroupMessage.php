<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property Carbon created_at
 * @property string message
 * @property User sender
 */
class GroupMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_id',
    ];

    public function sender(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
