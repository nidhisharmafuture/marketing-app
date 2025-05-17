@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit Task</h4>
    <form action="{{ route('designer.tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="title" class="form-label">Task Title</label>
        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4" required>{{ $task->description }}</textarea>
      </div>

      <div class="mb-3">
        <label for="township_id" class="form-label">Select Township</label>
        <select name="township_id" class="form-control" required>
          @foreach($townships as $township)
            <option value="{{ $township->id }}" {{ $task->township_id == $township->id ? 'selected' : '' }}>
              {{ $township->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">Select Category</label>
        <select name="category_id" class="form-control" required>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->title }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="media_type" class="form-label">Media Type</label>
        <select name="media_type" class="form-control" required>
          <option value="image" {{ $task->media_type == 'image' ? 'selected' : '' }}>Image</option>
          <option value="video" {{ $task->media_type == 'video' ? 'selected' : '' }}>Video</option>
          <option value="pdf" {{ $task->media_type == 'pdf' ? 'selected' : '' }}>PDF</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="file_path" class="form-label">Upload New File (optional)</label>
        <input type="file" name="file_path" class="form-control">
        @if($task->file_path)
          <small class="form-text text-muted">
            Current File: <a href="{{ asset('tasks/' . $task->file_path) }}" target="_blank">View File</a>
          </small>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">Update Task</button>
             <a href="{{ route('designer.tasks.index') }}" class="btn btn-secondary">Back</a>

    </form>
  </div>
</div>
@endsection
