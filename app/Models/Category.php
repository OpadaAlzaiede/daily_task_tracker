<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public const DEFAULTS = [
        'Personal',
        'Work',
        'Shopping',
        'Travel',
        'Others',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
