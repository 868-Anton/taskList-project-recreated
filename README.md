## Reusing Form Markup in Laravel

### The Concept:

- The `include` directive in Blade allows you to reuse common parts of views, such as forms.
- This helps in maintaining **DRY (Don't Repeat Yourself)** principles by reducing redundant code.
- The `isset` and `@isset` directives help to conditionally include content based on whether a variable is set.
- Note: Only reuse forms when it makes sense for the application.

### Use Case:

- To create a reusable form component that can be used for both creating and editing tasks.

### Step-by-Step Guide:

1. **Create a Common Form View:**
    - Create a new Blade file for the form markup that will be shared between the create and edit views.
2. **Extract Form Markup:**
    - Copy the form markup from one of the existing forms (create or edit) into the new form view.
3. **Use Conditionals to Handle Differences:**
    - Use the `isset` directive to check if the task variable is set to determine if the form is for creating or editing a task.
4. **Include the Common Form View:**
    - Use the `@include` directive to include the common form view in both the create and edit views.

### Code Example:

1. **Create the Common Form View:**
    
    ```php
    // resources/views/form.blade.php
    @extends('layouts.app')
    
    @section('title', isset($task) ? 'Edit Task' : 'Add Task')
    
    @section('styles')
      <style>
        .error-message {
          color: red;
          font-size: 0.8rem;
        }
      </style>
    @endsection
    
    @section('content')
      <form method="POST"
        action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
          @method('PUT')
        @endisset
        <div>
          <label for="title">Title</label>
          <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}" />
          @error('title')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>
    
        <div>
          <label for="description">Description</label>
          <textarea name="description" id="description" rows="5">{{ $task->description ?? old('description') }}</textarea>
          @error('description')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>
    
        <div>
          <label for="long_description">Long Description</label>
          <textarea name="long_description" id="long_description" rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
          @error('long_description')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>
    
        <div>
          <button type="submit">
            @isset($task)
              Update Task
            @else
              Add Task
            @endisset
          </button>
        </div>
      </form>
    @endsection
    
    ```
    
2. **Update the Create View:**
    
    ```php
    // resources/views/create.blade.php
    @extends('layouts.app')
    
    @section('content')
      @include('form')
    @endsection
    
    ```
    
3. **Update the Edit View:**
    
    ```php
    // resources/views/edit.blade.php
    @extends('layouts.app')
    
    @section('content')
      @include('form', ['task' => $task])
    @endsection
    
    ```
    

## Final Refactored Code:

### Common Form View:

```php
// resources/views/form.blade.php
@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')
  <style>
    .error-message {
      color: red;
      font-size: 0.8rem;
    }
  </style>
@endsection

@section('content')
  <form method="POST"
    action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
    @csrf
    @isset($task)
      @method('PUT')
    @endisset
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}" />
      @error('title')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" rows="5">{{ $task->description ?? old('description') }}</textarea>
      @error('description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="long_description">Long Description</label>
      <textarea name="long_description" id="long_description" rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
      @error('long_description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <button type="submit">
        @isset($task)
          Update Task
        @else
          Add Task
        @endisset
      </button>
    </div>
  </form>
@endsection

```

### Create View:

```php
// resources/views/create.blade.php
@extends('layouts.app')

@section('content')
  @include('form')
@endsection

```

### Edit View:

```php
// resources/views/edit.blade.php
@extends('layouts.app')

@section('content')
  @include('form', ['task' => $task])
@endsection

```