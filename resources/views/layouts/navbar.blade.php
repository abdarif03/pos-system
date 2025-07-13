<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">POS System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Dashboard - Available for all roles -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>

                <!-- Products - Available for admin and cashier -->
                @if(Auth::user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                </li>
                @endif

                <!-- Transactions - Available for all roles -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="transaksiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Transaksi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="transaksiDropdown">
                        <li><a class="dropdown-item" href="{{ route('transactions.index') }}">Daftar Transaksi</a></li>
                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('cashier'))
                        <li><a class="dropdown-item" href="{{ route('transactions.create') }}">Buat Transaksi Baru</a></li>
                        <li><hr class="dropdown-divider"></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('reports.index') }}">Laporan Transaksi</a></li>
                    </ul>
                </li>

                <!-- Profit Reports - Available for admin and cashier -->
                @if(Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="labaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Laporan Laba
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="labaDropdown">
                        <li><a class="dropdown-item" href="{{ route('profits.index') }}">Dashboard Laba</a></li>
                        <li><a class="dropdown-item" href="{{ route('profits.daily') }}">Laba Harian</a></li>
                        <li><a class="dropdown-item" href="{{ route('profits.weekly') }}">Laba Mingguan</a></li>
                        <li><a class="dropdown-item" href="{{ route('profits.monthly') }}">Laba Bulanan</a></li>
                        <li><a class="dropdown-item" href="{{ route('profits.yearly') }}">Laba Tahunan</a></li>
                    </ul>
                </li>
                @endif

                <!-- Settings - Available only for admin -->
                @if(Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pengaturanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengaturan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="pengaturanDropdown">
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Kelola User</a></li>
                        <li><a class="dropdown-item" href="{{ route('roles.index') }}">Kelola User Role</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}">Kategori Produk</a></li>
                    </ul>
                </li>
                @endif
            </ul>
            
            <!-- User Menu -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-1"></i>{{ Auth::user()->name ?? 'User' }}
                        <span class="badge bg-secondary ms-1">{{ ucfirst(Auth::user()->role) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><span class="dropdown-item-text text-muted">{{ Auth::user()->email ?? '' }}</span></li>
                        <li><span class="dropdown-item-text text-muted">Role: {{ ucfirst(Auth::user()->role) }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item" onclick="return confirm('Yakin ingin logout?')">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
