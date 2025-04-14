@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Create Role</h1>

    <form action="{{ route('roles.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700">Role Name</label>
            <input type="text" name="name" id="name" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">Create Role</button>
    </form>
</div>
@endsection
