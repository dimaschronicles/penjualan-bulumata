<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/product">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data Produk</li>
        </ol>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img src="/img/produk/<?= $produk['gambar_produk']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fw-bold">Nama Produk :</span> <?= $produk['nama_produk']; ?></h5>
                        <h6>Deskipsi Produk :</h6>
                        <?= $produk['deskripsi_produk']; ?>
                        <hr>
                        <ul>
                            <li><b>Harga : </b>Rp <?= format_rupiah($produk['harga_produk']); ?>,00</li>
                            <li><b>Stok : </b><?= ($produk['stok_produk'] == null) ? 0 : $produk['stok_produk'];  ?></li>
                            <li><b>Tanggal input : </b><?= $produk['time_created']; ?></li>
                        </ul>
                        <a href="#" class="btn btn-primary" onclick="window.close()">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>