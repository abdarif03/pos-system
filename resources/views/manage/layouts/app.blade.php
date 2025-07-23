<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manage System')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('manage.dashboard') }}" class="flex-shrink-0 flex items-center">
                        <i class="fas fa-cogs text-2xl text-blue-600 mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">Manage System</span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    @php $user = Auth::guard('manage')->user(); @endphp
                    @if($user && $user->hasPermission('dashboard'))
                    <a href="{{ route('manage.dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                    </a>
                    @endif
                    @if($user && $user->hasPermission('clients'))
                    <a href="{{ route('manage.clients.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-users mr-1"></i>Clients
                    </a>
                    @endif
                    @if($user && $user->hasPermission('payments'))
                    <a href="{{ route('manage.payments.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-money-bill mr-1"></i>Payments
                    </a>
                    @endif
                    @if($user && $user->hasPermission('users'))
                    <a href="{{ route('manage.users.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-user-cog mr-1"></i>Users
                    </a>
                    @endif
                    @if($user && $user->hasPermission('packages'))
                    <a href="{{ route('manage.packages.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-box-open mr-1"></i>Packages
                    </a>
                    @endif
                    
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium focus:outline-none">
                            <i class="fas fa-user mr-1"></i>{{ Auth::guard('manage')->user()->name }}
                            <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50" style="display: none;">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <div class="font-semibold text-gray-800">{{ Auth::guard('manage')->user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::guard('manage')->user()->email }}</div>
                                <div class="text-xs text-gray-400 mt-1">Role: {{ ucfirst(Auth::guard('manage')->user()->role) }}</div>
                            </div>
                            <a href="{{ route('manage.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-id-badge mr-2"></i>Profile
                            </a>
                            @if(in_array(Auth::guard('manage')->user()->role, ['superadmin', 'admin']))
                            <a href="{{ route('manage.roles.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-shield mr-2"></i>Access Management
                            </a>
                            @endif
                            <form method="POST" action="{{ route('manage.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')
    <!-- Add Alpine.js for dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html> 