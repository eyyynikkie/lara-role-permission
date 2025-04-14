@extends('layouts.app')

@section('title', 'Register')

@section('header', 'Create a New Account')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow border border-purple-100">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-purple-700 font-medium">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-purple-700 font-medium">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('email') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-purple-700 font-medium">Password</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('password') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-purple-700 font-medium">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>

        <!-- Register Button -->
        <div class="mt-4">
            <button type="submit" class="bg-purple-300 hover:bg-purple-400 text-white py-2 px-4 rounded shadow w-full">
                Register
            </button>
        </div>
    </form>
</div>
@endsection
