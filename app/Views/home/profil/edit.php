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
                        <form action="/profile/editprofile" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_user" value="<?= session('id_user') ?>">
                            <input type="hidden" name="oldImage" value="<?= $user['foto'] ?>">
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
                            <div class="form-group <?= ($validation->hasError('foto')) ? 'has-error' : ''; ?>">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto" accept="image/*" onchange="loadFile(event)">
                                <span id="helpBlock2" class="help-block"><?= $validation->getError('foto'); ?></span>
                            </div>
                            <div class="form-group">
                                <img src="/img/user/<?= $user['foto']; ?>" id="foto-profil" width="150px">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Profil</button>
                            <a class="btn btn-default" href="/profile">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<script>
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('foto-profil');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
<?= $this->endSection(); ?>