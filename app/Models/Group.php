<?php

namespace App\Models;

use App\UUID;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use UUID;
    protected $guarded = [];
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
