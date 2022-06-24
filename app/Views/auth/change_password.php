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
                        <h3 class="panel-title">Reset Password</h3>
                    </div>
                    <div class="panel-body">
                        <p class="help-block">Reset password untuk email : <b><?= session()->get('reset_email'); ?></b></p>
                        <form action="/reset" method="POST">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="email" value="<?= session()->get('reset_email'); ?>">
                            <div class="form-group <?= ($validation->hasError('password')) ? 'has-error' : ''; ?>">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span id=" helpBlock2" class="help-block"><?= $validation->getError('password'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('password_conf')) ? 'has-error' : ''; ?>">
                                <label for="password_conf">Password</label>
                                <input type="password" class="form-control" id="password_conf" name="password_conf" placeholder="Konfirmasi Password">
                                <span id=" helpBlock2" class="help-block"><?= $validation->getError('password_conf'); ?></span>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" onclick="seePasswordReg()"> Show Password
                                </label>
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