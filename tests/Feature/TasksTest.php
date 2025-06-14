<?php

use App\Models\Task;
use App\Models\User;
use App\Models\Category;

test('tasks can be listed', function () {

    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->get(route('tasks.index'));

    $response->assertOk();
    $response->assertSee($task->name);
});

test('tasks can be filtered by category', function () {

    $user = User::factory()->create();
    $categoryOne = Category::factory()->create();
    Category::factory()->create();
    $taskOne = Task::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
    ]);
    $taskTwo = Task::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
    ]);

    $response = $this->actingAs($user)->get(route('tasks.index', [
        'category' => $categoryOne->id,
    ]));

    $response->assertOk();
    $response->assertSee($taskOne->name);
    $response->assertDontSee($taskTwo->name);
});

test('task can be created', function() {

    $user = User::factory()->create();
    $category = Category::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->post(route('tasks.store'), [
        'title' => 'Task title',
        'description' => 'Task description',
        'category_id' => $category->id,
        'due_date' => fake()->date(),
    ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'title' => 'Task title',
        'description' => 'Task description',
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);
    $response->assertSessionHas('message', 'Task created successfully.');
});
