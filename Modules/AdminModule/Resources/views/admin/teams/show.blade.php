@extends('adminmodule::layouts.app')
@section('content')
<div class="container">
    <h2>Team Details</h2>
    <p><strong>Name:</strong> {{ $team->name }}</p>
    <p><strong>Status:</strong> {{ $team->status ? 'Active' : 'Inactive' }}</p>
            <a href="{{ route('admin.team.list') }}" class="btn btn-primary">Back</a>

</div>
@endsection

