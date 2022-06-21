<?= $this->extend('layout/home/templates'); ?>
<?= $this->section('content'); ?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <?= session()->getFlashdata('message'); ?>

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

                        <form action="/transaction/upload/<?= $transaksi['id_transaksi']; ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                            <div class="form-group <?= ($validation->hasError('bukti')) ? 'has-error' : ''; ?>">
                                <label for="bukti">Bukti Pembayaran</label>
                                <input type="file" class="form-control" id="bukti" name="bukti" placeholder="bukti Lengkap" value="<?= old('bukti'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('bukti'); ?></span>
                            </div>
                            <button type="submit" class="btn btn-success">Upload</button>
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