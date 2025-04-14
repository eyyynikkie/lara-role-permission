@extends('layouts.app')

@section('title', 'Login')

@section('header', 'Login to Your Account')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow border border-purple-100">
    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        <!-- Remember Me -->
        <div class="mb-4">
            <label for="remember" class="inline-flex items-center text-purple-700">
                <input type="checkbox" id="remember" name="remember" class="text-purple-600 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                <span class="ml-2">Remember Me</span>
            </label>
        </div>

        <!-- Login Button -->
        <div class="mt-4">
            <button type="submit" class="bg-purple-300 hover:bg-purple-400 text-white py-2 px-4 rounded shadow w-full">
                Login
            </button>
        </div>
    </form>
</div>
@endsection
