<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kategori</li>
        </ol>

        <div class="mt-3">
            <?= session()->getFlashdata('message'); ?>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <a href="/category/new" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Data Kategori
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Data Kategori
            </div>
            <div class="card-body text-center">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($kategori as $k) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $k['nama_jenis']; ?></td>
                                <td>
                                    <form action="/category/<?= $k['id_jenis']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type=" submit" class="btn btn-danger" onclick="return confirm('Apakah data ini akan dihapus?')">Hapus</button>
                                    </form>
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