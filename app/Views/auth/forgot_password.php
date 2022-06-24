<?= $this->extend('layout/home/templates'); ?>
<?= $this->section('content'); ?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="col">

                <?= session()->getFlashdata('message'); ?>

                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">Lupa Password</h3>
                    </div>
                    <div class="panel-body">
                        <form action="/forgot" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group <?= ($validation->hasError('email')) ? 'has-error' : ''; ?>">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email anda" value="<?= old('email'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('email'); ?></span>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                                <p class="help-block" style="margin-top: 10px;"><a href="/login">Kembali</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<?= $this->endSection(); ?>