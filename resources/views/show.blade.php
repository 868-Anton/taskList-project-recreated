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

<p>
  @if ($task->completed)
  Completed
  @else Not completed
  @endif
</p>

<div>
  <form method="POST" action="{{ route('tasks.destroy', ['task'=>$task->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
  </form>
</div>

<div>
  <form action="{{ route('tasks.toggle-complete', ['task'=>$task] )}}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit">
      Mark as {{ $task->completed ? 'not completed' : 'is completed' }}
    </button>
  </form>
</div>

<div>
  <a href="{{ route('tasks.edit',['task'=>$task->id]) }}">Edit</a>
</div>
@endsection