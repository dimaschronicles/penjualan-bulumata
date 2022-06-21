<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Produk</li>
        </ol>

        <div class="mt-3">
            <?= session()->getFlashdata('message'); ?>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <a href="/product/new" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Data Produk
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
                            <th>Gambar</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($produk as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><img src="/img/produk/<?= $p['gambar_produk']; ?>" alt="" width="250px"></td>
                                <td><?= $p['kode_produk']; ?></td>
                                <td><?= $p['nama_produk']; ?></td>
                                <td>Rp <?= format_rupiah($p['harga_produk']); ?>,00</td>
                                <td>
                                    <form action="/product/<?= $p['id_produk']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type=" submit" class="btn btn-danger" onclick="return confirm('Apakah data ini akan dihapus?')">Hapus</button>
                                    </form>
                                    <a href="/product/<?= $p['id_produk']; ?>/edit" class="btn btn-warning">Edit</a>
                                    <a href="/product/<?= $p['id_produk']; ?>" class="btn btn-info" target="_blank">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>