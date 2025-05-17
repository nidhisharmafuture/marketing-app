@extends('adminmodule::layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Task Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Title:</strong> {{ $task->title }}</p>
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Category:</strong> {{ $task->category->title ?? '-' }}</p>
            <p><strong>Township:</strong> {{ $task->township->name ?? '-' }}</p>
            <p><strong>Designer:</strong> {{ $task->designer->name ?? '-' }}</p>
            <p><strong>Media Type:</strong> {{ ucfirst($task->media_type) }}</p>
            <p><strong>Status:</strong>
                @if ($task->status == 1)
                    <span class="badge bg-warning">Submitted</span>
                @elseif ($task->status == 2)
                    <span class="badge bg-success">Approved</span>
                @else
                    <span class="badge bg-danger">Rejected</span>
                @endif
            </p>
            <p><strong>Publish Status:</strong>
                @if ($task->publish_status)
                    <span class="badge bg-success">Published</span>
                @else
                    <span class="badge bg-secondary">Unpublished</span>
                @endif
            </p>

            <p><strong>File:</strong><br>
                @if($task->file_path)
                    @if(Str::contains($task->media_type, 'image'))
                        <img src="{{ asset('tasks/' . $task->file_path) }}" class="img-fluid" style="max-height: 300px;">
                    @elseif(Str::contains($task->media_type, 'video'))
                        <video controls width="400">
                            <source src="{{ asset('tasks/' . $task->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <a href="{{ asset('tasks/' . $task->file_path) }}" target="_blank" class="btn btn-info">View File</a>
                    @endif
                @else
                    <p>No file uploaded.</p>
                @endif
            </p>

            <a href="{{ route('designer.tasks.index') }}" class="btn btn-secondary mt-3">Back to Tasks</a>
        </div>
    </div>
</div>
@endsection
