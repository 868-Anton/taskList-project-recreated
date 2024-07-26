<?php

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

//Gets all Tasks
Route::get('/tasks', function () {
    $tasks = Task::latest()->get();
    return view('index', ['tasks' => $tasks]);
})->name('tasks.index');

//Define a route to display the form
Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');


Route::get('/tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');


// Route to handle form submission
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('Success', 'Congratulations, your task has been created!');
})->name('tasks.store');


Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('Success', 'Task has been Updated!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with('Success', 'Task Deleted');
})->name('tasks.destroy');
