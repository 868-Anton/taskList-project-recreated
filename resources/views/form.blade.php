@extends('layout.app')

@section('title', isset($task)? 'Edit Task' : 'Create Task')


@section('content')
  <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]): route('tasks.store') }}">
    @csrf
    @isset($task)
    @method('PUT')
    @endisset
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" @class(['border-red-500'=>$errors->has('title')]) value="{{ $task->title ?? old('title') }}" />
      @error('title')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" @class(['border-red-500'=>$errors->has('description')]) rows="5">{{ $task->description ?? old('description') }}</textarea>
      @error('description')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="long_description">Long Description</label>
      <textarea name="long_description" id="long_description" @class(['border-red-500'=>$errors->has('long_description')]) rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
      @error('long_description')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <button type="submit" class="btn">
        @isset($task)
        Edit Task
        @else
        Create Task
        @endisset
        </button>
        <a href="{{ route('tasks.index') }}" class="btn">Cancel</a>
    </div>


  </form>
@endsection