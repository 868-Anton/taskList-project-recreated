# Refactoring and Improving Laravel Routes

## Route Model Binding

### The Concept:

- Route model binding **automatically fetches the model instance** based on the route parameter.
- It simplifies the code by **removing the need to manually query the database in the route**.

### Use Case:

- To automatically resolve the `Task` model based on the route parameter.

### Code Snippet:

```php
// Use route model binding to fetch the task
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');
```

### Code Example:

```php
// routes/web.php
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');
```

## Form Requests for Validation

### The Concept:

- Form requests **encapsulate validation logic**, allowing you to reuse the same validation rules in multiple routes.
- They provide a clean way to validate incoming data before the controller handles it.

### Use Case:

- To extract and reuse validation rules for creating and updating tasks.

### Code Snippet:

```php
// Create a form request for task validation
php artisan make:request TaskRequest

// Define validation rules in the form request
public function rules(): array
{
    return [
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ];
}
```

### Code Example:

```php
// app/Http/Requests/TaskRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'required'
        ];
    }
}
```

## Using `create` and `update` Methods

### The Concept:

- The `create` and `update` methods simplify the process of saving models to the database.
- They allow you to assign multiple attributes at once using mass assignment.

### Use Case:

- To create or update a `Task` model instance with a single line of code.

### Code Snippet:

```php
// Use the create method for new tasks
$task = Task::create($request->validated());

// Use the update method for existing tasks
$task->update($request->validated());
```

### Code Example:

```php
// routes/web.php
use App\Http\Requests\TaskRequest;
use App\Models\Task;

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');
```

## Fillable Properties for Mass Assignment

### The Concept:

- The `fillable` property specifies which attributes should be mass assignable.
- It protects against mass assignment vulnerabilities by explicitly defining which attributes can be set.

### Use Case:

- To allow mass assignment for specific attributes of the `Task` model.

### Code Snippet:

```php
// Define fillable properties in the model
protected $fillable = ['title', 'description', 'long_description'];
```

### Code Example:

```php
// app/Models/Task.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description'];
}
```

## Final Refactored Code

### Updated Routes

```php
// routes/web.php
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');
```

### Updated Task Model

```php
// app/Models/Task.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description'];
}
```

### Updated Blade Templates

```php
// resources/views/edit.blade.php
@extends('layouts.app')

@section('title', 'Edit Task')

@section('styles')
  <style>
    .error-message {
      color: red;
      font-size: 0.8rem;
    }
  </style>
@endsection

@section('content')
  <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
    @csrf
    @method('PUT')
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" />
      @error('title')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" rows="5">{{ old('description', $task->description) }}</textarea>
      @error('description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="long_description">Long Description</label>
      <textarea name="long_description" id="long_description" rows="10">{{ old('long_description', $task->long_description) }}</textarea>
      @error('long_description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <button type="submit">Edit Task</button>
    </div>
  </form>
@endsection
```