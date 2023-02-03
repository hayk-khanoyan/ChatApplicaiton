<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property int id
 * @property Carbon created_at
 * @property string name
 * @property string type
 * @property int creator_id
 * @property int participants_count
 */
class Group extends Model
{
    use HasFactory;

    public function participants(): HasMany
    {
        return $this->hasMany(GroupParticipant::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(GroupMessage::class);
    }

    public function history(): MorphOne
    {
        return $this->morphOne(UserChat::class, 'messageable');
    }
}
