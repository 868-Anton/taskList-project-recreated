
@extends('layout.app')

@section('title', 'The List of Tasks')

@section('content')

{{-- @if (count($tasks)> 0)
  @foreach ($tasks as $task)
    <p>{{ $task->title }}</p>
  @endforeach
    @else
    <p>There are no Tasks</p>
@endif --}}

<div>
  <a href="{{ route('tasks.create') }}" class="link">Add Task!</a>
</div>

<div class="mt-4">
  @forelse ($tasks as $task )
  <div>
    <a href="{{ route('tasks.show',['task'=>$task->id]) }}" @class(['line-through'=>$task->completed])>{{ $task->title }}</a>
    
  </div>
  @empty
  <p>No Tasks available</p>
  @endforelse
</div>

@if ($tasks->count())
  <nav class="mt-10">
    {{ $tasks->links() }}
  </nav>
@endif
  

@endsection