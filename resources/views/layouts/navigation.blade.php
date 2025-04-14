<nav class="bg-pink-100 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side: Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-pink-600 font-bold text-lg">
                    🎀 LaraRole Blog
                </a>
            </div>

            <!-- Center: Navigation Links -->
            <div class="hidden sm:flex sm:space-x-6 sm:items-center">
                <a href="{{ route('dashboard') }}" class="text-purple-700 hover:text-purple-900 font-medium">Dashboard</a>
                <a href="{{ route('posts.index') }}" class="text-purple-700 hover:text-purple-900 font-medium">Posts</a>
                <a href="{{ route('categories.index') }}" class="text-purple-700 hover:text-purple-900 font-medium">Categories</a>
                <a href="{{ route('tags.index') }}" class="text-purple-700 hover:text-purple-900 font-medium">Tags</a>
            </div>

            <!-- Right Side: User Dropdown -->
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-gray-600">👋 Hello, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-purple-300 text-white px-3 py-1 rounded hover:bg-purple-400 text-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-purple-700 hover:text-purple-900 text-sm">Login</a>
                    <a href="{{ route('register') }}" class="bg-purple-300 text-white px-3 py-1 rounded hover:bg-purple-400 text-sm">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
