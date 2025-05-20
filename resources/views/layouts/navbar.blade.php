<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">POS System</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}">Transaksi system</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>
