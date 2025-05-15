@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Edit Media</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.media.update', $media->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $media->title }}" required>
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <br>
            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('admin.media.list') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
