<?php

namespace App\Console\Commands;

use App\Models\RecurringTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateRecurringTasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-recurring-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $now = Carbon::now();
        $tasks = [];

        RecurringTask::query()
            ->where('next_due_date', '<=', $now)
            ->chunk(100, function ($recurringTasks) use (&$tasks, $now) {
                foreach ($recurringTasks as $recurringTask) {

                    $nextDueDate = $recurringTask->calculateNextDueDate();

                    $tasks[] = [
                        'recurring_task_id' => $recurringTask->id,
                        'user_id' => $recurringTask->user_id,
                        'category_id' => $recurringTask->category_id,
                        'title' => $recurringTask->title,
                        'description' => $recurringTask->description,
                        'due_date' => $nextDueDate,
                        'created_at' => $now,
                    ];

                    $recurringTask->update([
                        'next_due_date' => $nextDueDate,
                    ]);
                }

                Task::insert($tasks);
                $tasks = [];
            });
        $this->info('Recurring tasks generated successfully.');
    }
}
