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
                    <h3 class="title">Profil</h3>
                </div>
            </div>
            <!-- /section title -->

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Data User</strong></div>
                    <div class="panel-body">
                        <form action="/profile/editprofile" method="POST">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="input" type="text" name="username" id="username" value="<?= $user['username']; ?>" readonly>
                            </div>
                            <div class="form-group <?= ($validation->hasError('email')) ? 'has-error' : ''; ?>">
                                <label for="email">Email</label>
                                <input class="input" type="email" name="email" id="email" value="<?= $user['email']; ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('email'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('nama')) ? 'has-error' : ''; ?>">
                                <label for="nama">Nama</label>
                                <input class="input" type="text" name="nama" id="nama" value="<?= $user['nama_lengkap']; ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('nama'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('no_hp')) ? 'has-error' : ''; ?>">
                                <label for="no_hp">No. HP/WA</label>
                                <input class="input" type="number" name="no_hp" id="no_hp" value="<?= $user['no_hp']; ?>">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('no_hp'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('alamat')) ? 'has-error' : ''; ?>">
                                <label for="alamat">Alamat</label>
                                <textarea class="input" type="text" name="alamat" id="alamat"><?= $user['alamat']; ?></textarea>
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('alamat'); ?></span>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Profil</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Ganti Password</strong></div>
                    <div class="panel-body">
                        <form action="/profile/changepassword" method="POST">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                            <div class="form-group <?= ($validation->hasError('current_password')) ? 'has-error' : ''; ?>">
                                <label for="current_password">Password Saat Ini</label>
                                <input class="input" type="password" name="current_password" id="current_password">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('current_password'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('new_password')) ? 'has-error' : ''; ?>">
                                <label for="new_password">Password Baru</label>
                                <input class="input" type="password" name="new_password" id="new_password">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('new_password'); ?></span>
                            </div>
                            <div class="form-group <?= ($validation->hasError('new_password_conf')) ? 'has-error' : ''; ?>">
                                <label for="new_password_conf">Konfirmasi Password Baru</label>
                                <input class="input" type="password" name="new_password_conf" id="new_password_conf">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('new_password_conf'); ?></span>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" onclick="seePassProfil()"> Show Password
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Password</button>
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