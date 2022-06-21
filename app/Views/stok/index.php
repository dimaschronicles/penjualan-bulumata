<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Stok Produk</li>
        </ol>

        <div class="mt-3">
            <?= session()->getFlashdata('message'); ?>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <a href="/stock/new" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Stok Produk
                </a>
                <a href="/stock/min" class="btn btn-secondary">
                    <i class="fas fa-minus"></i>
                    Kurang Stok Produk
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Data Produk
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Stok</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1;
                        foreach ($produk as $p) :
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['kode_produk']; ?></td>
                                <td><?= $p['nama_produk']; ?></td>
                                <td><?= ($p['stok_produk'] == null) ? 0 : $p['stok_produk']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>