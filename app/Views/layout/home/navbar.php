<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="<?= ($title == 'Home') ? 'active' : ''; ?>"><a href="/home">Home</a></li>
                <li class="<?= ($title == 'Semua Produk') ? 'active' : ''; ?>"><a href="/allproduk">Semua Produk</a></li>
                <?php if (session()->get('role') == 2) : ?>
                    <li class="<?= ($title == 'Riwayat Pembelian') ? 'active' : ''; ?>"><a href="/riwayat">Riwayat Pembelian</a></li>
                <?php endif; ?>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>