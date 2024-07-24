@extends('layout.app')

@section('title', 'Add a Task')

@section('styles')
<style>
  .error-message{
    color: red;
    font-size: 0.8rem;
  };
</style>
@endsection

@section('content')

{{-- @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif --}}
<form method="POST" action="{{ route('tasks.store') }}">
  @csrf
  <div>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}"/>
    @error('title')
      <p class="error-message" >{{ $message }}<p>
    @enderror
  </div>

  <div>
    <label for="description">Description</label>
    <textarea name="description" id="description" value="{{ old('description')}} rows="5"></textarea>
  </div>

  <div>
    <label for="long_description">Long Description</label>
    <textarea name="long_description" id="long_description" value="{{ old('long_description')}}rows="10"></textarea>
  </div>

  <div>
    <button type="submit">Add Task</button>
  </div>
</form>

@endsection