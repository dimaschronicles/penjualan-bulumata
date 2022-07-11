<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Transaksi</li>
        </ol>

        <div class="mt-3">
            <?= session()->getFlashdata('message'); ?>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Transaksi
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Customer</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Customer</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($transaksi as $t) : ?>
                            <?php if ($t['status'] != 'keranjang') : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>TR-<?= $t['id_transaksi']; ?></td>
                                    <td><?= $t['nama_lengkap']; ?></td>
                                    <td>Rp <?= format_rupiah(intval($t['ongkir'] + $t['total_harga'])); ?>,00</td>
                                    <td>
                                        <?php if ($t['status'] == 'pembayaran') : ?>
                                            <span class="badge rounded-pill bg-warning"><?= $t['status']; ?></span>
                                        <?php elseif ($t['status'] == 'menunggu') : ?>
                                            <span class="badge rounded-pill bg-secondary"><?= $t['status']; ?></span>
                                        <?php elseif ($t['status'] == 'dikirim') : ?>
                                            <span class="badge rounded-pill bg-info"><?= $t['status']; ?></span>
                                        <?php elseif ($t['status'] == 'selesai') : ?>
                                            <span class="badge rounded-pill bg-success"><?= $t['status']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($t['status'] == 'menunggu') : ?>
                                            <a href="/transaksi/kirim/<?= $t['id_transaksi']; ?>" class="btn btn-secondary">Kirim</a>
                                        <?php endif; ?>
                                        <a href="/transaksi/<?= $t['id_transaksi']; ?>" class="btn btn-info" target="_blank">Detail</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>