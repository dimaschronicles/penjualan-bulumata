<?= $this->extend('layout/home/templates'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div id="breadcrumb" class="section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Produk</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="/">Home</a></li>
                    <li class="active"><?= $produk['nama_produk']; ?></li>
                </ul>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- row -->
    <div class="row">
        <!-- Product main img -->
        <div class="col-md-5">
            <div id="product-main-img">
                <div class="product-preview">
                    <img src="/img/produk/<?= $produk['gambar_produk']; ?>" alt="">
                </div>
            </div>
        </div>
        <!-- /Product main img -->

        <!-- Product thumb imgs -->
        <div class="col-md-2 ">
        </div>
        <!-- /Product thumb imgs -->

        <!-- Product details -->
        <div class="col-md-5">
            <div class="product-details">
                <h2 class="product-name"><?= $produk['nama_produk']; ?></h2>
                <div>
                    <h3 class="product-price">Rp <?= format_rupiah($produk['harga_produk']) ?>,00</h3>
                </div>

                <div class="add-to-cart">
                    <form action="/addcart" method="POST">
                        <?= csrf_field(); ?>
                        <label for="jumlah">Jumlah</label>
                        <!-- <input class="input" type="number" min="1" value="1" name="jumlah"> -->
                        <div>
                            <input type="button" class="btn btn-danger" onclick="decrementValue()" value="-" />
                            <div class="col-xs-3">
                                <input type="number" class="input" name="jumlah" value="1" id="number" readonly />
                            </div>
                            <input type="button" class="btn btn-success" onclick="incrementValue()" value="+" />
                        </div>
                        <br>
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                        <input type="hidden" name="harga_produk" value="<?= $produk['harga_produk']; ?>">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> tambah ke keranjang</button>
                    </form>
                </div>

                <ul class="product-links">
                    <li>Tipe/Jenis:</li>
                    <li><?= $produk['nama_jenis']; ?></li>
                </ul>
                <ul class="product-links">
                    <strong>
                        <li>Stok:</li>
                        <li><?= $produk['stok_produk']; ?></li>
                    </strong>
                </ul>

            </div>
        </div>
        <!-- /Product details -->

        <!-- Product tab -->
        <div class="col-md-12">
            <div id="product-tab">
                <!-- product tab nav -->
                <ul class="tab-nav">
                    <li class="active"><a data-toggle="tab" href="#tab1">Deskripsi</a></li>
                    <!-- <li><a data-toggle="tab" href="#tab2">Details</a></li> -->
                    <li><a data-toggle="tab" href="#tab3">Komentar</a></li>
                </ul>
                <!-- /product tab nav -->

                <!-- product tab content -->
                <div class="tab-content">
                    <!-- tab1  -->
                    <div id="tab1" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $produk['deskripsi_produk']; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /tab1  -->

                    <!-- tab2  -->
                    <div id="tab2" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /tab2  -->

                    <!-- tab3  -->
                    <div id="tab3" class="tab-pane fade in">
                        <div class="row">

                            <!-- Reviews -->
                            <div class="col-md-8">
                                <div id="reviews">
                                    <ul class="reviews">
                                        <?php foreach ($komentar as $k) : ?>
                                            <?php if ($k['id_produk'] == $produk['id_produk']) : ?>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name"><?= $k['nama_lengkap']; ?></h5>
                                                        <p class="date"><?= $k['tanggal_komentar']; ?></p>
                                                    </div>
                                                    <div class="review-body">
                                                        <p><?= $k['isi_komentar']; ?></p>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <!-- <ul class="reviews-pagination">
                                        <li class="active">1</li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul> -->
                                </div>
                            </div>
                            <!-- /Reviews -->

                            <!-- Review Form -->
                            <div class="col-md-4">
                                <div id="review-form">
                                    <!-- <form class="review-form">
                                        <input type="hidden" name="id_produk" id="id_produk" value="<?= $produk['id_produk']; ?>">
                                        <textarea class="input" name="isi_komentar" id="isi_komentar" placeholder="Komentar"></textarea>
                                        <div class="input-rating">
                                            <span>Your Rating: </span>
                                            <div class="stars">
                                                <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                            </div>
                                        </div>
                                        <button class="primary-btn">Kirim</button>
                                    </form> -->
                                    <a href="/komentar/tulis/<?= $produk['id_produk']; ?>" class="primary-btn">Tulis Komentar</a>
                                </div>
                            </div>
                            <!-- /Review Form -->
                        </div>
                    </div>
                    <!-- /tab3  -->
                </div>
                <br><br>
                <!-- /product tab content  -->
            </div>
        </div>
        <!-- /product tab -->
    </div>
    <!-- /row -->
</div>
<?= $this->endSection(); ?>