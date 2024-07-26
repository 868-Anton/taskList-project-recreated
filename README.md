# Deleting Data in Laravel

## Deleting a Task

### **The Concept:**

- Use the `DELETE` HTTP verb to delete a record from the database.
- Implement route model binding to fetch the task by its ID.
- Use the model's `delete` method to remove the record.

### **Use Case:**

- To delete a task from the database permanently.

### **Code Snippet:**

```php
phpCopy code
// Define the route to delete a task
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

```

### **Code Example:**

```php
// routes/web.php
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

```

## Blade Template for Delete Button

### **The Concept:**

- Use a form with method spoofing to send a `DELETE` request.
- Include CSRF protection and method spoofing directives in the form.

### **Use Case:**

- To create a form in the Blade template that allows users to delete a task.
    - The form is added to the `show.blade.php` .

### **Code Snippet:**

```php
// Create a form with method spoofing for DELETE
<form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>

```

### **Code Example:**

```php
// resources/views/show.blade.php
@extends('layouts.app')

@section('title', $task->title)

@section('content')
  <h1>{{ $task->title }}</h1>
  <p>{{ $task->description }}</p>
  <p>{{ $task->long_description }}</p>

  <div>
    <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit">Delete</button>
    </form>
  </div>
  
@endsection

```

## Complete Example

### Routes Configuration

```php
 // routes/web.php
use App\Models\Task;
use Illuminate\Support\Facades\Route;

// Route to display a specific task
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

// Route to display the edit form for a task
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

// Route to delete a task
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('Success', 'Task deleted successfully!');
})->name('tasks.destroy');

```

## **Soft Deletes (Optional)**

- Laravel supports soft deletes, which mark a record as deleted without removing it from the database.
- This is achieved by adding a `deleted_at` column to the table.
- To use soft deletes, add the `SoftDeletes` trait to the model.
- Soft deletes allow the record to be "hidden" while still being retrievable if needed.

### Code Snippet:

```php
namespace App\\Models;

use Illuminate\\Database\\Eloquent\\Model;
use Illuminate\\Database\\Eloquent\\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}

```