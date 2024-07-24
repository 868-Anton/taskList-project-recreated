
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
    <a href="{{ route('tasks.show',['id'=>$task->id]) }}">{{ $task->title }}</a>
  </div>
  @empty
  <p>No Tasks available</p>
@endforelse

@endsection