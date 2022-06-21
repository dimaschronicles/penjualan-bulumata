<?= $this->extend('layout/home/templates'); ?>
<?= $this->section('content'); ?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <?= session()->getFlashdata('message'); ?>
            </div>

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title"><?= $title; ?></h3>
                </div>
            </div>
            <!-- /section title -->

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Ongkir</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($transaksi as $t) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $t['nama_lengkap']; ?></td>
                                        <td>Rp <?= format_rupiah($t['total_harga']); ?>,00</td>
                                        <td>Rp <?= format_rupiah($t['ongkir']); ?>,00</td>
                                        <td>Rp <?= format_rupiah(intval($t['ongkir'] + $t['total_harga'])); ?>,00</td>
                                        <td>
                                            <?php if ($t['status'] == 'pembayaran') : ?>
                                                <span class="label label-warning"><?= $t['status']; ?></span>
                                            <?php elseif ($t['status'] == 'menunggu') : ?>
                                                <span class="label label-default"><?= $t['status']; ?></span>
                                            <?php elseif ($t['status'] == 'dikirim') : ?>
                                                <span class="label label-info"><?= $t['status']; ?></span>
                                            <?php elseif ($t['status'] == 'selesai') : ?>
                                                <span class="label label-success"><?= $t['status']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/invoice" class="btn btn-danger" target="_blank">Nota</a>
                                            <?php if ($t['status'] == 'pembayaran') : ?>
                                                <a href="/transaction/bukti/<?= $t['id_transaksi']; ?>" class="btn btn-warning">Upload</a>
                                            <?php endif; ?>
                                            <?php if ($t['status'] == 'dikirim') : ?>
                                                <a href="/transaction/konfirmasi/<?= $t['id_transaksi']; ?>" class="btn btn-primary">Konfirmasi</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php if ($t['status'] == 'dikirim') : ?>
                                        <tr>
                                            <td colspan="7"><b>*</b><i>Jika barang sudah sampai silahkan klik tombol konfirmasi untuk mengkonfirmasi bahwa barang sudah sampai ke pembeli.</i></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<?= $this->endSection(); ?>