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
                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        <div class="image-cropper">
                            <img src="/img/user/<?= $user['foto']; ?>" class="foto-profil">
                        </div>
                        <h3 style="margin-top: 10px;"><?= session('username'); ?></h3>
                        <p style="margin-bottom: 10px;"><?= $user['nama_lengkap'] ?> | <?= $user['email']; ?></p>
                        <a class="btn btn-primary" href="/profile/edit">Edit Profile</a>
                        <a class="btn btn-danger" href="/profile/change">Ganti Password</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<?= $this->endSection(); ?>