<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/product">Stok</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kurang Stok Produk</li>
        </ol>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <b>Form Kurang Stok Produk</b>
            </div>
            <div class="card-body">
                <form action="/stock/min" method="POST">
                    <?= csrf_field(); ?>
                    <div class="mb-3 row">
                        <label for="id_produk" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= ($validation->hasError('id_produk')) ? 'is-invalid' : ''; ?>" name="id_produk" id="id_produk">
                                <option value="">=== Pilih Produk ===</option>
                                <?php foreach ($produk as $p) : ?>
                                    <option value="<?= $p['id_produk']; ?>" <?= ($p['id_produk'] == old('id_produk')) ? 'selected' : ''; ?>><?= $p['kode_produk'] ?> | <?= $p['nama_produk'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_produk'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah_produk" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_produk')) ? 'is-invalid' : ''; ?>" id="jumlah_produk" name="jumlah_produk" value="<?= old('jumlah_produk'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jumlah_produk'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="/stock" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>