@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-4">Role Details: {{ $role->name }}</h1>

    <h3 class="text-xl font-semibold mb-2">Permissions</h3>
    <ul class="list-disc pl-6">
        @forelse($role->permissions as $permission)
            <li class="text-gray-700">{{ $permission->name }}</li>
        @empty
            <li class="text-gray-500">No permissions assigned yet.</li>
        @endforelse
    </ul>

    <a href="{{ route('roles.edit', $role->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 mt-4 inline-block">Edit Role</a>
</div>
@endsection
