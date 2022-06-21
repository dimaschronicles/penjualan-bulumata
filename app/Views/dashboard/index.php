<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        User
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        Jumlah : <?= $totalUser; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-dark mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        Produk
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        Jumlah : <?= $totalProduk; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        Total Stok
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        Jumlah : <?= $totalStok['stok_produk']; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        Transaksi
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        Jumlah : <?= $totalTransaksi; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
<?= $this->endSection(); ?>