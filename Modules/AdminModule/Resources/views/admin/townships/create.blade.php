@extends('adminmodule::layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Add New Township</h2>

    <form action="{{ route('admin.township.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="form-group">
            <label>RERA No (optional)</label>
            <input type="text" name="rera_no" class="form-control">
        </div>

        <button class="btn btn-primary mt-3">Create Township</button>
                    <a href="{{ route('admin.township.list') }}" class="btn btn-primary">Back</a>

    </form>
</div>
@endsection

