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
                        <h3 class="panel-title">Form Login</h3>
                    </div>
                    <div class="panel-body">
                        <form action="/login" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group <?= ($validation->hasError('username')) ? 'has-error' : ''; ?>">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= old('username'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('username'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('password')) ? 'has-error' : ''; ?>">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span id=" helpBlock2" class="help-block"><?= $validation->getError('password'); ?></span>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" onclick="seePassword()"> Show Password
                                </label>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <p class="help-block" style="margin-top: 10px;">Belum punya akun? <a href="/register">Daftar disini</a></p>
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