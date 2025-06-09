<?php

use App\Console\Commands\GenerateRecurringTasksCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(GenerateRecurringTasksCommand::class)->dailyAt('00:00');
