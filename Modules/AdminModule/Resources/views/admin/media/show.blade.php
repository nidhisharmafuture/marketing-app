@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h4>Media Details</h4></div>
    <div class="card-body">
        <p><strong>Title:</strong> {{ $media->title }}</p>
        {{-- <p><strong>Admin ID:</strong> {{ $category->admin }}</p> --}}
        <a href="{{ route('admin.media.list') }}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection
