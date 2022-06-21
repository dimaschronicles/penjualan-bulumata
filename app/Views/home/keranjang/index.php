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
            <?php if ($cart != null) : ?>
                <a href="/transaction" class="btn btn-primary" style="margin-bottom: 10px;">Transaksi</a>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $c) : ?>
                                <tr>
                                    <td>
                                        <img src="/img/produk/<?= $c['gambar_produk']; ?>" alt="" width="100px">
                                    </td>
                                    <td><?= $c['nama_produk']; ?></td>
                                    <td><?= $c['jumlah']; ?></td>
                                    <td>Rp <?= format_rupiah($c['harga_produk']) ?>,00</td>
                                    <td>
                                        <b>Rp <?= format_rupiah($c['total_harga']) ?>,00</b>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr style="background-color: #eeeee4;">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td colspan="3"></td>
                                <td>
                                    <h5>Rp <?= format_rupiah(intval($total[0]['total_harga'])); ?>,00</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<?= $this->endSection(); ?>