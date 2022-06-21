<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/product">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Produk</li>
        </ol>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <b>Form Tambah Data Produk</b>
            </div>
            <div class="card-body">
                <form action="/product" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3 row">
                        <label for="kode_produk" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('kode_produk')) ? 'is-invalid' : ''; ?>" id="kode_produk" name="kode_produk" value="<?= old('kode_produk'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_produk'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_produk" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" value="<?= old('nama_produk'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_produk'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="deskripsi_produk" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="deskripsi_produk" value="<?= old('deskripsi_produk'); ?>">
                            <textarea id="mytextarea" name="deskripsi_produk"><?= old('deskripsi_produk'); ?></textarea>
                            <?php if ($validation->hasError('deskripsi_produk')) : ?>
                                <span style="font-size: 14px;" class="text-danger"><?= $validation->getError('deskripsi_produk'); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_jenis" class="col-sm-2 col-form-label">Jenis</label>
                        <div class="col-sm-10">
                            <select class="form-control <?= ($validation->hasError('id_jenis')) ? 'is-invalid' : ''; ?>" id="id_jenis" name="id_jenis">
                                <option value="">=== Pilih Jenis ===</option>
                                <?php foreach ($jenis as $j) : ?>
                                    <option value="<?= $j['id_jenis']; ?>" <?= (old('id_jenis') == $j['id_jenis']) ? 'selected' : ''; ?>><?= $j['nama_jenis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_jenis'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga_produk" class="col-sm-2 col-form-label">Harga (Rp.)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('harga_produk')) ? 'is-invalid' : ''; ?>" id="harga_produk" name="harga_produk" value="<?= old('harga_produk'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga_produk'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gambar_produk" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input class="form-control  <?= ($validation->hasError('gambar_produk')) ? 'is-invalid' : ''; ?>" type="file" accept="image/*" id="gambar_produk" name="gambar_produk" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar_produk'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <img src="" id="frame" class="img-fluid" width="250px">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="/product" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>