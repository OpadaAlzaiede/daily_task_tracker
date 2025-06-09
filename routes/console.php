<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\GenerateRecurringTasksCommand;

Schedule::command(GenerateRecurringTasksCommand::class)->dailyAt('00:00');
