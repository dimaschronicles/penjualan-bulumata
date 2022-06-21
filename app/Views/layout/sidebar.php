<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Administrator</div>
                <a class="nav-link <?= ($title == "Dashboard") ? 'active' : ''; ?>" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link <?= ($title == "Data Kategori") ? 'active' : ''; ?>" href="/category">
                    <div class="sb-nav-link-icon"><i class="fas fa-shapes"></i></div>
                    Kategori
                </a>
                <a class="nav-link <?= ($title == "Data Produk") ? 'active' : ''; ?>" href="/product">
                    <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                    Produk
                </a>
                <a class="nav-link <?= ($title == "Stok Produk") ? 'active' : ''; ?>" href="/stock">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Stok
                </a>
                <a class="nav-link <?= ($title == "Transaksi") ? 'active' : ''; ?>" href="/transaksi">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    Transaksi
                </a>
                <hr>
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                    Kembali Ke Home
                </a>

            </div>
        </div>
    </nav>
</div>