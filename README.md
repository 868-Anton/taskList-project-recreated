# Implementing Task Editing and Completion Toggling in Laravel

## Adding an Edit Link

### **The Concept:**

- Add a link to the task show page that redirects to the task edit form.

### **Use Case:**

- To navigate to the task editing form from the task details page.

### **Code Snippet:**

```php
<div>
  <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
</div>

```

### **Code Example:**

```php
// resources/views/show.blade.php

<p>{{ $task->created_at }}</p>
<p>{{ $task->updated_at }}</p>

<p>
  @if ($task->completed)
    Completed
  @else
    Not completed
  @endif
</p>

<div>
  <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
</div>

```

## Adding a New Task Link

### **The Concept:**

- Add a link on the main task index page to navigate to the task creation form.

### **Use Case:**

- To allow users to quickly add a new task.

### **Code Snippet:**

```php
<div>
  <a href="{{ route('tasks.create') }}">Add Task!</a>
</div>

```

### **Code Example:**

```php
// resources/views/index.blade.php

@section('title', 'The list of tasks')

@section('content')
  <div>
    <a href="{{ route('tasks.create') }}">Add Task!</a>
  </div>

  @forelse ($tasks as $task)
    <div>
      <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
    </div>
  @empty
    <div>There are no tasks!</div>
  @endforelse

  @if ($tasks->count())
    <nav>
      {{ $tasks->links() }}
    </nav>
  @endif
@endsection

```

## Implementing Task Completion Toggling

### **The Concept:**

- Create a route to toggle the completion status of a task.
- Add a form in the task details view to toggle the completion status.

### **Use Case:**

- To mark a task as completed or not completed.

### **Code Snippet:**

```php
// Define the route
Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

// Add method to the model
public function toggleComplete()
{
    $this->completed = !$this->completed;
    $this->save();
}

// Add form in the task details view (show)
<div>
  <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
    @csrf
    @method('PUT')
    <button type="submit">
      Mark as {{ $task->completed ? 'not completed' : 'completed' }}
    </button>
  </form>
</div>

```

### **Code Example:**

1. **Task Model:**
    
    ```php
    // app/Models/Task.php
    namespace App\\Models;
    
    use Illuminate\\Database\\Eloquent\\Factories\\HasFactory;
    use Illuminate\\Database\\Eloquent\\Model;
    
    class Task extends Model
    {
        use HasFactory;
    
        protected $fillable = ['title', 'description', 'long_description'];
    
        public function toggleComplete()
        {
            $this->completed = !$this->completed;
            $this->save();
        }
    }
    
    ```
    
2. **Routes Configuration:**
    
    ```php
    // routes/web.php
    use App\\Models\\Task;
    use Illuminate\\Support\\Facades\\Route;
    
    Route::put('tasks/{task}/toggle-complete', function (Task $task) {
        $task->toggleComplete();
    
        return redirect()->back()->with('success', 'Task updated successfully!');
    })->name('tasks.toggle-complete');
    
    ```
    
3. **Task Details View:**
    
    ```php
    // resources/views/show.blade.php
    
    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>
    
    <p>
      @if ($task->completed)
        Completed
      @else
        Not completed
      @endif
    </p>
    
    <div>
      <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
    </div>
    
    <div>
      <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
        @csrf
        @method('PUT')
        <button type="submit">
          Mark as {{ $task->completed ? 'not completed' : 'completed' }}
        </button>
      </form>
    </div>
    
    <div>
      <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
      </form>
    </div>
    
    ```
    

### Explanation:

- **Edit Link:** Adds an edit link to the task details page using the `route` helper.
- **Add Task Link:** Adds a link to the main task index page to create a new task.
- **Toggle Complete:** Adds a route and a method to the `Task` model to toggle the completion status of a task. A form is added to the task details view to trigger the toggle.

### Conclusion:

This guide covers how to add links for editing and creating tasks and implement a feature to toggle the completion status of a task. Using route model binding and method spoofing in forms ensures a clean and efficient approach to managing task states in Laravel.