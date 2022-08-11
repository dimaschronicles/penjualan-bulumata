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

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="/komentar/update/<?= $komentar['id_komentar']; ?>" method="POST">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_komentar" value="<?= $komentar['id_komentar']; ?>">
                            <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                            <input type="hidden" name="id_user" value="<?= session('id_user'); ?>">
                            <input type="hidden" name="tanggal_waktu" value="<?= date('Y-m-d h:i:s') ?>">
                            <div class="form-group <?= ($validation->hasError('isi_komentar')) ? 'has-error' : ''; ?>">
                                <textarea class="input" name="isi_komentar" id="isi_komentar" placeholder="Komentar"><?= $komentar['isi_komentar']; ?></textarea>
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('isi_komentar'); ?></span>
                            </div>
                            <button type="submit" class="primary-btn">Kirim</button>
                            <a href="/beli/<?= $produk['id_produk']; ?>" style="margin-left: 10px;">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<?= $this->endSection(); ?>