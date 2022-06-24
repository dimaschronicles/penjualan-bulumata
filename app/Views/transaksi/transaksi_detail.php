<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                Detail Transaksi
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="id_transaksi" class="col-sm-2 col-form-label">Id Transaksi</label>
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <li class="list-group-item">TR-<?= $transaksi['id_transaksi']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <li class="list-group-item"><?= $transaksi['nama_lengkap']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="no_hp" class="col-sm-2 col-form-label">No. HP/WA</label>
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <li class="list-group-item"><?= $transaksi['no_hp']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <li class="list-group-item"><?= $transaksi['alamat']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="total" class="col-sm-2 col-form-label">Total Pembayaran</label>
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <li class="list-group-item">Rp <?= format_rupiah(intval($transaksi['ongkir'] + $transaksi['total_harga'])); ?>,00</li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="total" class="col-sm-2 col-form-label">Daftar Produk Yang Dibeli</label>
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <?php $i = 1;
                            foreach ($transaksiProduk as $p) : ?>
                                <li class="list-group-item"><?= $i++; ?>. <?= $p['nama_produk']; ?> | Jumlah : <?= $p['jumlah']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="bukti" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                    <div class="col-sm-10">
                        <?php if ($transaksi['bukti_bayar'] == null) : ?>
                            <p><i>*Belum melakukan pembayaran</i></p>
                        <?php else : ?>
                            <img src="/img/bukti/<?= $transaksi['bukti_bayar']; ?>" class="img-thumbnail" width="500px">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <a href="#" onclick="window.close()" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>