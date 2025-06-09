<?php

namespace App\Models;

use App\Enums\RecurringTaskUnit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringTask extends Model
{
    protected $fillable = [
        'title',
        'description',
        'frequency',
        'frequency_unit',
        'user_id',
        'category_id',
        'start_date',
        'next_due_date',
    ];

    protected $casts = [
        'next_due_date' => 'date',
        'start_date' => 'date',
        'frequency' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function calculateNextDueDate(): Carbon
    {
        $frequency = $this->frequency;
        $frequencyUnit = RecurringTaskUnit::tryFrom($this->frequency_unit);
        $dueDate = Carbon::parse($this->next_due_date);

        return match ($frequencyUnit->value) {
            RecurringTaskUnit::DAY->value => $dueDate->addDays($frequency),
            RecurringTaskUnit::WEEK->value=> $dueDate->addWeeks($frequency),
            RecurringTaskUnit::MONTH->value => $dueDate->addMonths($frequency),
            RecurringTaskUnit::YEAR->value => $dueDate->addYears($frequency),
        };
    }
}
