<?= $this->extend('layout/home/templates'); ?>
<?= $this->section('content'); ?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Products tab & slick -->
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="row">
                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Pengiriman</h3>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="input" name="alamat" placeholder="Alamat lengkap lokasi pengiriman..." readonly><?= session()->get('alamat'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kurir">Kurir</label>
                                <input class="input" type="text" name="kurir" value="JNE - Reguler" readonly>
                            </div>
                            <div class="form-group">
                                <label for="estimasi">Estimasi Pengiriman</label>
                                <input class="input" type="text" name="estimasi" value="3-7 hari" readonly>
                            </div>
                        </div>
                        <!-- /Billing Details -->

                        <!-- Shiping Details -->
                        <!-- <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Alamat Pengiriman</h3>
                            </div>
                        </div> -->
                        <!-- /Shiping Details -->

                        <!-- Order notes -->
                        <!-- <div class="order-notes">
                            <textarea class="input" readonly><?= session()->get('alamat'); ?></textarea>
                        </div> -->
                        <!-- /Order notes -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Pesanan Anda</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUK</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                <?php foreach ($produk as $p) : ?>
                                    <div class="order-col">
                                        <div><?= $p['jumlah']; ?>x <?= $p['nama_produk']; ?></div>
                                        <div>Rp <?= format_rupiah($p['total_harga']); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="order-col">
                                <div>Ongkir</div>
                                <div><strong>Rp 20.000</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">Rp <?= format_rupiah(intval($total[0]['total_harga']) + 20000); ?></strong></div>
                            </div>
                        </div>
                        <!-- <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="#">terms & conditions</a>
                            </label>
                        </div> -->
                        <form action="/transaction/pesan" method="POST">
                            <?= csrf_field(); ?>
                            <!-- transaksi -->
                            <input type="hidden" name="total_harga" value="<?= intval($total[0]['total_harga']); ?>">
                            <input type="hidden" name="ongkir" value="<?= intval(20000); ?>">
                            <button type="submit" class="primary-btn order-submit" style="width: 100%;">Pesan</button>
                        </form>
                    </div>
                    <!-- /Order Details -->
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<?= $this->endSection(); ?>