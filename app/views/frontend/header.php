        <!-- ============================================
        ==================== Header =====================
        ============================================= -->

        <header id="header" class="transparent-header <?= $theme ?>"><!-- class .sticky-mobile makes header sticky on small devices -->

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="main-navbar-toggle"><i class="fa fa-bars"></i></div>

                    <!-- ============================================
                    =================== Branding ====================
                    ============================================= -->

                    <div id="branding">
                        <a href="<?= BASE_URL ?>" class="brand-normal" data-light-logo="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png"><img src="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png" alt="Minovate"></a>
                        <a href="<?= BASE_URL ?>" class="brand-retina" data-light-logo="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png"><img src="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png" alt="Minovate"></a>
                    </div><!-- #branding end -->

                    <!-- ============================================
                    ================= Main Navbar ===================
                    ============================================= -->

                    <nav id="main-navbar">

                        <ul>
                            <li class="active"><a href="#">Info</a>
                                <ul>
                                    <li><a href="<?= BASE_URL ?>visi-misi">Visi Misi</a></li>
                                    <li><a href="#">Sejarah</a></li>
                                    <li><a href="#">Struktur Organisasi</a></li>
                                    <li><a href="#">Fasilitas</a></li>
                                    <li><a href="#">Ekstrakulikuler</a></li>
                                    <li><a href="#">Prestasi</a></li>
                                    <li><a href="#">Testimoni</a></li>
                                    <li><a href="<?= BASE_URL ?>kontak">Hubungi Kami</a></li>
                                </ul>
                            </li>
                            <li class="mega-menu"><a href="#">Bidang Keahlian</a>
                                <div class="mega-menu-content col-4">
                                    <?php foreach ($jurusan as $key => $value):?>
                                        <ul class="border-bottom">
                                            <li class="mega-menu-title"><a href="<?= BASE_URL."departemen/$key/".strtolower($value['name']) ?>"><i class="fa fa-angle-right"></i> <?= $value['name'] ?></a>
                                                <ul>
                                                    <?php foreach ($value['jurusan'] as $key2 => $value2) :?>
                                                      <li><a href="<?= BASE_URL."jurusan/$value2->jurusan_id" ?>"><?= $value2->jurusan_name ?></a></li>
                                                    <?php endforeach ?>
                                                    
                                                </ul>
                                            </li>
                                        </ul>
                                    <?php endforeach ?>
                                </div>
                            </li>
                            <!-- <li><a href="#">SSB</a></li> -->
                            <li><a href="#">News & Event</a>
                                <ul>
                                    <li><a href="<?= BASE_URL ?>news">News</a></li>
                                    <li><a href="<?= BASE_URL ?>events">Event</a></li>
                                    <!-- <li><a href="#">Pengumuman</a></li> -->
                                </ul>
                            </li>
                            <!-- <li><a href="#">Gallery</a> -->
                            </li>
                        </ul>


                        <!-- ==============================================
                        ================= Search Toggle ===================
                        =============================================== -->

                        <!-- <div id="search-toggle"> <span>|</span> <a href="#"><i class="fa fa-search"></i></a> </div> -->


                    </nav><!-- #main-navbar end -->

                </div>

            </div>

        </header><!-- #header end -->