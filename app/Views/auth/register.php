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
                        <h3 class="panel-title">Form Register</h3>
                    </div>
                    <div class="panel-body">
                        <form action="/register" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group <?= ($validation->hasError('email')) ? 'has-error' : ''; ?>">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= old('email'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('email'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('username')) ? 'has-error' : ''; ?>">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= old('username'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('username'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('nama')) ? 'has-error' : ''; ?>">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= old('nama'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('nama'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('alamat')) ? 'has-error' : ''; ?>">
                                <label for="alamat">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= old('alamat'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('alamat'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('no_hp')) ? 'has-error' : ''; ?>">
                                <label for="no_hp">No HP/WA</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP / WA" value="<?= old('no_hp'); ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('no_hp'); ?></span>
                            </div>
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
                                <button type="submit" class="btn btn-primary">Register</button>
                                <p class="help-block" style="margin-top: 10px;">Sudah punya akun? <a href="/login">Login disini</a></p>
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