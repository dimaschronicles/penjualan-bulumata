<?= $this->extend('layout/home/templates'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h3 class="title"><?= $title; ?></h3>
            </div>
        </div>

        <div class="col-md-12">

            <?= session()->getFlashdata('message'); ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $c) : ?>
                        <?php if ($c['status'] == 'keranjang') : ?>
                            <tr>
                                <td>
                                    <img src="/img/produk/<?= $c['gambar_produk']; ?>" alt="" width="100px">
                                </td>
                                <td><?= $c['nama_produk']; ?></td>
                                <td><?= $c['jumlah_produk']; ?></td>
                                <td>Rp <?= format_rupiah($c['harga_produk']) ?>,00</td>
                                <td>
                                    <b>Rp <?= format_rupiah($c['total_harga']) ?>,00</b>
                                </td>
                                <td>
                                    <a href="/transaction/transaksi/<?= $c['id_transaksi']; ?>" class="btn btn-success">Transaksi</a>
                                    <a href="" class="btn btn-danger">Hapus</a>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?= $c['id_transaksi']; ?>">Edit</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="myModal<?= $c['id_transaksi']; ?>" role="dialog">
                                <div class="modal-dialog modal-sm">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Ubah Jumlah</h4>
                                        </div>
                                        <form action="/transaction/editjumlah/<?= $c['id_transaksi']; ?>" method="POST">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="id_transaksi" value="<?= $c['id_transaksi']; ?>">
                                                <input type="hidden" name="harga_produk" value="<?= $c['harga_produk']; ?>">
                                                <input type="number" class="input" name="jumlah" id="jumlah" value="<?= $c['jumlah_produk']; ?>" min="1">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif;; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>