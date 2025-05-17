@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Submit New Task</h4>
    <form action="{{ route('designer.tasks.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="title" class="form-label">Task Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter task title" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4" placeholder="Enter task description" required></textarea>
      </div>

      <div class="mb-3">
        <label for="township_id" class="form-label">Select Township</label>
        <select name="township_id" class="form-control" required>
          <option value="">Choose Township</option>
          @foreach($townships as $township)
            <option value="{{ $township->id }}">{{ $township->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">Select Category</label>
        <select name="category_id" class="form-control" required>
          <option value="">Choose Category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="media_type" class="form-label">Media Type</label>
        <select name="media_type" class="form-control" required>
          <option value="">Select Media Type</option>
          <option value="image">Image</option>
          <option value="video">Video</option>
          <option value="pdf">PDF</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="file_path" class="form-label">Upload File</label>
        <input type="file" name="file_path" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">Submit Task</button>
             <a href="{{ route('designer.tasks.index') }}" class="btn btn-secondary">Back</a>

    </form>
  </div>
</div>
@endsection
