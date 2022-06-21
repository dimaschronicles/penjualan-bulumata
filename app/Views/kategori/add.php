<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/category">Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Kategori</li>
        </ol>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <b>Form Tambah Data Kategori</b>
            </div>
            <div class="card-body">
                <form action="/category" method="POST">
                    <?= csrf_field(); ?>
                    <div class="mb-3 row">
                        <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('nama_kategori')) ? 'is-invalid' : ''; ?>" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_kategori'); ?>
                            </div>
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