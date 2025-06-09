<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'completed_at',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function recurringTask()
    {
        return $this->belongsTo(RecurringTask::class);
    }
}
