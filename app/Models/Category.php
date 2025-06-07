<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
