@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Create Media</h4></div>
    <div class="card-body">
        <form action="{{ route('admin.media.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <br>
            <button class="btn btn-success" type="submit">Create</button>
            <a href="{{ route('admin.media.list') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
