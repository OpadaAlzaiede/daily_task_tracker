<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function getStatistics()
    {
        $startOfTheDay = now()->startOfDay();
        $endOfTheDay = now()->endOfDay();
        $now = now();

        $stats = Task::query()
                    ->selectRaw('
                        COUNT(CASE WHEN completed_at >= ? AND completed_at < ? THEN 1 END) as completed_today,
                        COUNT(CASE WHEN due_date >= ? AND due_date < ? AND completed_at IS NULL THEN 1 END) as incomplete_today,
                        COUNT(CASE WHEN due_date < ? THEN 1 END) as overdue
                    ', [
                        $startOfTheDay,
                        $endOfTheDay,
                        $startOfTheDay,
                        $endOfTheDay,
                        $now
                    ])
                    ->where('user_id', auth()->user()->id)
                    ->first();

        $dueTodayTasks = Task::query()
                        ->where('due_date', '>=', $startOfTheDay)
                        ->where('due_date', '<', $endOfTheDay)
                        ->whereNull('completed_at')
                        ->where('user_id', auth()->user()->id)
                        ->paginate(10);

        $dueTomorrowTasks = Task::query()
                        ->where('due_date', '>=', $now->copy()->addDay()->startOfDay())
                        ->where('due_date', '<', $now->copy()->addDay()->endOfDay())
                        ->where('user_id', auth()->user()->id)
                        ->whereNull('completed_at')
                        ->paginate(10);

        return view('dashboard.statistics', [
            'numOfCompletedTasksToday' => $stats->completed_today,
            'numOfIncompleteTasksToday' => $stats->incomplete_today,
            'numOfOverdueTasks' => $stats->overdue,
            'dueTodayTasks' => $dueTodayTasks,
            'dueTomorrowTasks' => $dueTomorrowTasks,
        ]);
    }
}
