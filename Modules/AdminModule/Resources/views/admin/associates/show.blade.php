@extends('adminmodule::layouts.app')

@section('content')
<div class="container">
    <h2>Associate Details</h2>
    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $associate->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $associate->email }}</li>
        <li class="list-group-item"><strong>Phone:</strong> {{ $associate->phone }}</li>
        <li class="list-group-item"><strong>RERA No:</strong> {{ $associate->rera_no }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $associate->status ? 'Active' : 'Inactive' }}</li>
    </ul>
    <a href="{{ route('admin.associate.list') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection


