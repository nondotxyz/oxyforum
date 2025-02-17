<?php

namespace App\Models;

use App\Models\Topic;
use App\Models\User;
use App\UUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posts extends Model
{
    use UUID;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function getTitleAttribute(): string
    {
        return $this->topic ? "RE: " . $this->topic->title : "RE: (No Topic)";

    }
}
