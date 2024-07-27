@extends('layout.app')

@section('title', $task->title)


@section('content')

<div class="mb-4 underline">
  <a href="{{ route('tasks.index') }}">🔙 Go Back to Task List</a>
</div>

<p class="mb-4">{{ $task->description }}</p>

@if($task->long_description)
<p class="mb-4">{{ $task->long_description }}</p>
@endif


<p class="mb-4">
  @if ($task->completed)
  <span class="font-medium text-green-500">Completed</span>
  @else <span class="font-medium text-red-500">Not completed</span>
  @endif
</p>

<p class="mb-4 text-slate-500 text-sm">
  Created {{ $task->created_at->diffForHumans() }} · {{ $task->updated_at->diffForHumans() }}
</p>

<div class="flex gap-3">
  <div class="btn">
    <a href="{{ route('tasks.edit',['task'=>$task->id]) }}">Edit</a>
  </div>

  <div class="btn">
    <form method="POST" action="{{ route('tasks.destroy', ['task'=>$task->id]) }}">
      @csrf
      @method('DELETE')
      <button type="submit">Delete</button>
    </form>
  </div>
  
  <div class="btn">
    <form action="{{ route('tasks.toggle-complete', ['task'=>$task] )}}" method="POST">
      @csrf
      @method('PUT')
      <button type="submit">
        Mark as {{ $task->completed ? 'not completed' : 'is completed' }}
      </button>
    </form>
  </div>
  
</div>
@endsection