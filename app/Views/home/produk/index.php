<?= $this->extend('layout/home/templates'); ?>
<?= $this->section('content'); ?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Semua Produk</h3>
                </div>
            </div>

            <!-- STORE -->
            <div id="store" class="col-md-12">
                <!-- store top filter -->
                <!-- <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Urutkan:
                            <select class="input-select">
                                <option value="">Produk Terbaru</option>
                                <option value="">Harga Tinggi ke Rendah</option>
                                <option value="">Harga Rendah ke Tinggi</option>
                            </select>
                        </label>
                        <button class="btn btn-primary"><i class="fas fa-sort"></i> Urut</button>
                    </div>
                </div> -->
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    <!-- product -->
                    <?php foreach ($produk as $p) : ?>
                        <div class="col-md-4 col-xs-6">
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
                        </div>
                        <div class="clearfix visible-sm visible-xs"></div>
                    <?php endforeach; ?>

                    <!-- /product -->
                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <!-- <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products</span>
                    <ul class="store-pagination">
                        <li class="active">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div> -->
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<?= $this->endSection(); ?>