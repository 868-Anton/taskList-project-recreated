## Pagination

## Implementing Pagination in Laravel

### The Concept:

- Pagination divides the results into pages, making it easier to navigate large sets of data.
- Laravel provides a simple and efficient way to implement pagination using the `paginate` method.
- The `paginate` method generates pagination links and handles query parameters for page navigation.

### Use Case:

- To paginate the list of tasks so that only a certain number of tasks are displayed per page, with navigation links to access other pages.

### Step-by-Step Guide:

1. **Update the Route to Use Pagination:**
    - Replace the `get` method with the `paginate` method to divide the results into pages.
2. **Display Pagination Links in Blade Template:**
    - Use the `links` method to generate pagination links in the view.

### Code Example:

1. **Update the Route to Use Pagination:**
    
    ```php
    // routes/web.php
    use App\\Models\\Task;
    use Illuminate\\Support\\Facades\\Route;
    
    Route::get('/tasks', function () {
        return view('index', [
            'tasks' => Task::latest()->paginate(10)
        ]);
    })->name('tasks.index');
    
    ```
    
2. **Display Pagination Links in Blade Template:**
    
    ```php
    // resources/views/index.blade.php
    @extends('layouts.app')
    
    @section('title', 'The list of tasks')
    
    @section('content')
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
    

## Final Refactored Code:

### Routes Configuration:

```php
// routes/web.php
use App\\Models\\Task;
use Illuminate\\Support\\Facades\\Route;

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

```

### Blade Template for Listing Tasks:

```php
// resources/views/index.blade.php
@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
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

### Explanation:

- **Route Update:** In the route definition, we replaced the `get` method with the `paginate` method. We passed `10` as an argument to the `paginate` method to specify that we want 10 tasks per page.
- **Blade Template Update:** In the Blade template, we used the `links` method on the `$tasks` variable to generate pagination links. This method automatically handles the creation of pagination links and manages the current page state.

### Conclusion:

This guide covers the implementation of pagination in Laravel. Pagination helps in managing large sets of data by dividing them into manageable pages, and Laravel's built-in pagination features make this process straightforward and efficient. The `paginate` method simplifies the creation and navigation of paginated results, and the `links` method in Blade generates the necessary navigation links.