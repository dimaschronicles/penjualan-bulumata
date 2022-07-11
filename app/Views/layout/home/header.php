<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href=""><i class="fa fa-phone"></i> (0281) 896229</a></li>
                <li><a href=""><i class="fa fa-envelope-o"></i> bintangmudaeyelash@email.com</a></li>
                <li><a href="https://www.google.com/maps/place/7%C2%B018'58.7%22S+109%C2%B016'49.7%22E/@-7.3163172,109.2782765,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x12456ddc14a8cc68!8m2!3d-7.3163172!4d109.2804652?hl=id" target="_blank"><i class="fa fa-map-marker"></i> Candiwulan, Kec. Kutasari, Kab. Purbalingga, Jawa Tengah, 53361.</a></li>
            </ul>
            <ul class="header-links pull-right">
                <?php if (!session('username')) : ?>
                    <li><a href="/login"><i class="fa fa-sign-in"></i> Login</a></li>
                <?php elseif (session('username')) : ?>
                    <?php if (session('role') == 1) : ?>
                        <li><a href=""><i class="fa fa-user-o"></i> <?= session()->get('username'); ?></a></li>
                    <?php elseif (session('role') == 2) : ?>
                        <li><a href="/profile"><i class="fa fa-user-o"></i> <?= session()->get('username'); ?></a></li>
                    <?php endif; ?>
                    <li><a href="/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="/" class="logo">
                            <img src="/img/logo.png" alt="" width="250px" style="margin-top: 12px;">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <!-- <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form> -->
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">

                        <!-- Cart -->
                        <div>
                            <a href="/cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <?php if ($jumlahCart) : ?>
                                    <div class="qty"><?= $jumlahCart; ?></div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <!-- /Cart -->

                        <?php if (session('role') == 1) : ?>
                            <div>
                                <a href="/dashboard">
                                    <i class="fa fa-lock"></i>
                                    <span>Panel</span>
                                    <!-- <div class="qty">3</div> -->
                                </a>
                            </div>
                        <?php endif; ?>

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>