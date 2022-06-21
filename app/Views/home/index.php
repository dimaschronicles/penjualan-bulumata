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
                    <h3 class="title">Produk Terbaru</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">

                                <!-- product -->
                                <?php foreach ($produk as $p) : ?>
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/img/produk/<?= $p['gambar_produk']; ?>" alt="<?= $p['nama_produk']; ?>">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Tipe/Jenis : <?= $p['nama_jenis']; ?></p>
                                            <h3 class="product-name"><?= $p['nama_produk']; ?></h3>
                                            <h4 class="product-price">Rp <?= format_rupiah($p['harga_produk']); ?>,00</h4>
                                            <h6 class="product-category">Stok : <?= $p['stok_produk']; ?></h6>
                                            <div class="product-rating">
                                            </div>
                                            <div class="product-btns">
                                                <a href="/beli/<?= $p['id_produk']; ?>" class="add-to-wishlist">
                                                    <i class="fa fa-shopping-cart"></i> Beli
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->

            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">

                        <!-- section title -->
                        <div class="col-md-12">
                            <div class="section-title">
                                <h3 class="title">Produk</h3>
                            </div>
                        </div>
                        <!-- /section title -->

                        <!-- Products tab & slick -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="products-tabs">
                                    <!-- tab -->
                                    <div id="tab2" class="tab-pane fade in active">
                                        <div class="products-slick" data-nav="#slick-nav-2">
                                            <!-- product -->
                                            <?php foreach ($produkOld as $p) : ?>
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="/img/produk/<?= $p['gambar_produk']; ?>" alt="<?= $p['nama_produk']; ?>">
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Tipe/Jenis : <?= $p['nama_jenis']; ?></p>
                                                        <h3 class="product-name"><?= $p['nama_produk']; ?></h3>
                                                        <h4 class="product-price">Rp <?= format_rupiah($p['harga_produk']); ?>,00</h4>
                                                        <h6 class="product-category">Stok : <?= $p['stok_produk']; ?></h6>
                                                        <div class="product-rating">
                                                        </div>
                                                        <div class="product-btns">
                                                            <a href="/beli/<?= $p['id_produk']; ?>" class="add-to-wishlist">
                                                                <i class="fa fa-shopping-cart"></i> Beli
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <!-- /product -->

                                        </div>
                                        <div id="slick-nav-2" class="products-slick-nav"></div>
                                    </div>
                                    <!-- /tab -->
                                </div>
                            </div>
                        </div>
                        <!-- /Products tab & slick -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<?= $this->endSection(); ?>