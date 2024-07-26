@extends('layout.app')

@section('title', $task->title)

<a href="{{ route('tasks.index') }}">🔙 Go Back to Task List</a>

@section('content')

<p>{{ $task->description }}</p>

@if($task->long_description)
<p>{{ $task->long_description }}</p>
@endif


<p>{{ $task->created_at }}</p>
<p>{{ $task->updated_at }}</p>

<div>
  <form method="POST" action="{{ route('tasks.destroy', ['task'=>$task->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
  </form>
</div>
@endsection