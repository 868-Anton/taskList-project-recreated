
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


@forelse ($tasks as $task )
  <div>
    <a href="{{ route('tasks.show',['task'=>$task->id]) }}">{{ $task->title }}</a>
  </div>
  @empty
  <p>No Tasks available</p>
@endforelse

@if ($tasks->count())
<div>
  <nav>
    {{ $tasks->links() }}
  </nav>
</div>
@endif
  

@endsection