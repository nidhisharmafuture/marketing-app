@extends('adminmodule::layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-5 text-center">
            <h2 class="text-2xl font-bold text-blue-600">{{ $totalDesigners }}</h2>
            <p class="text-gray-600 mt-1">Total Designers</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-5 text-center">
            <h2 class="text-2xl font-bold text-green-600">{{ $totalMedia }}</h2>
            <p class="text-gray-600 mt-1">Media Files</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-5 text-center">
            <h2 class="text-2xl font-bold text-purple-600">{{ $totalTeams }}</h2>
            <p class="text-gray-600 mt-1">Teams</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-5 text-center">
            <h2 class="text-2xl font-bold text-pink-600">{{ $totalTownships }}</h2>
            <p class="text-gray-600 mt-1">Townships</p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-3">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.designer.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Add Designer</a>
            <a href="{{ route('admin.media.create') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600">Add Media</a>
            <a href="{{ route('admin.team.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded shadow hover:bg-purple-600">Add Team</a>
            <a href="{{ route('admin.township.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded shadow hover:bg-pink-600">Add Township</a>
        </div>
    </div>

    {{-- Recent Items --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Recent Designers --}}
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-3">Recent Designers</h3>
            <ul>
                @foreach ($recentDesigners as $designer)
                    <li class="mb-2 border-b pb-2">
                        <div class="flex justify-between items-center">
                            <span>{{ $designer->name }} ({{ $designer->email }})</span>
                            <a href="{{ route('admin.designer.edit', $designer->id) }}" class="text-blue-500 hover:underline text-sm">Edit</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Recent Media --}}
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-3">Recent Media</h3>
            <ul>
                @foreach ($recentMedia as $media)
                    <li class="mb-2 border-b pb-2">
                        <div class="flex justify-between items-center">
                            <span>{{ $media->title }}</span>
                            <a href="{{ route('admin.media.edit', $media->id) }}" class="text-green-500 hover:underline text-sm">Edit</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Recent Teams --}}
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-3">Recent Teams</h3>
            <ul>
                @foreach ($recentTeams as $team)
                    <li class="mb-2 border-b pb-2">
                        <div class="flex justify-between items-center">
                            <span>{{ $team->name }}</span>
                            <a href="{{ route('admin.team.edit', $team->id) }}" class="text-purple-500 hover:underline text-sm">Edit</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Recent Townships --}}
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-3">Recent Townships</h3>
            <ul>
                @foreach ($recentTownships as $township)
                    <li class="mb-2 border-b pb-2">
                        <div class="flex justify-between items-center">
                            <span>{{ $township->name }} ({{ $township->location }})</span>
                            <a href="{{ route('admin.township.edit', $township->id) }}" class="text-pink-500 hover:underline text-sm">Edit</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
