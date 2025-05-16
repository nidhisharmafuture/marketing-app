@extends('adminmodule::layouts.app')


@section('content')
<div class="container">
    <h2>Edit Associate</h2>
    <form method="POST" action="{{ route('admin.associate.update', $associate->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $associate->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $associate->email }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $associate->phone }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>RERA No</label>
            <input type="text" name="rera_no" value="{{ $associate->rera_no }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.associate.list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection



