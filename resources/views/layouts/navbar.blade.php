<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">POS System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="transaksiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Transaksi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="transaksiDropdown">
                        <li><a class="dropdown-item" href="{{ route('transactions.index') }}">Daftar Transaksi</a></li>
                        <li><a class="dropdown-item" href="{{ route('transactions.create') }}">Buat Transaksi Baru</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('reports.index') }}">Laporan Transaksi</a></li>
                    </ul>
                </li>
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
            </ul>
        </div>
    </div>
</nav>
