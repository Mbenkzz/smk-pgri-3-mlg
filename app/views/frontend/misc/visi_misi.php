
<!DOCTYPE html>
<html>
<head>
    <?php $this->view('frontend/head.php') ?>
</head>

<body>
    <!-- ============================================
    ================= Page Wrapper ==================
    ============================================= -->

    <div id="wrapper" class="clearfix animsition">

        <?php $this->view('frontend/header.php', $header) ?>
        <!-- ============================================
        =================== Breadcrumbs =================
        ============================================= -->
        <section id="breadcrumbs" class="breadcrumbs-sm">

            <div class="container clearfix">
                <h1>Visi dan Misi</h1>
            </div>

        </section><!-- #breadcrumbs end -->

        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">

            <div class="content-wrap">


                <!-- ============ Features ============ -->
                <div class="container clearfix">



                    <div class="heading-block center less-width center-block mb-60">
                        <h1 class="text-uppercase">SMK PGRI 3 Malang</h1>
                        <p class="lead">Success by Discipline</p>
                    </div>


                    <div class="row">

                        <div class="col-12">
                            <div class="feature-box no-icon" data-animate="fadeIn">
                                <div class="heading">
                                    <h3 class="underline"><span class="text-theme">Visi</span> Kami</h3>
                                </div>
                                <p>Berakhlaqul karimah, Berkarakter Kuat dan Cerdas Untuk Menjadi Sekolah Vokasi Terbaik di Indonesia.</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="feature-box no-icon" data-animate="fadeIn" data-delay="200">
                                <div class="heading">
                                    <h3 class="underline"><span class="text-theme">Misi</span> Kami</h3>
                                </div>
                                <ol>
                                    <li>Membiasakan civitas akademika bertindak sesuai dengan nilai luhur budaya bangsa yang berasal dari ajaran agama yang di anut dan nilai sosial budaya</li>
                                    <li>Melaksanakan SMM yang berbasis ISO 9001:2015 untuk mengukur keberhasilan dan keberlanjutan program kerja sekolah dan kinerja pendidik dan tenaga kependidikan</li>
                                    <li>Melaksanakan Budaya Industri dengan didasari motto <b>Success by Discipline</b> di lingkungan sekolah</li>
                                    <li>Mewujudkan prestasi akademik dan non akademik yang kompetitif baik guru, karyawan dan peserta didik/siswa, pada kejuaraan atau lomba ditingkat internal sekolah, regional, nasional dan internasional</li>
                                    <li>Melaksanakan proses belajar mengajar yang mengacu pada standar kompetensi kerja nasional maupun standart kompetensi kerja internasional sekaligus mempertimbangkan kemampuan dasar baik bagi guru ataupun siswa dengan tetap berpedoman pada kurikulum 2013 terbaru</li>
                                    <li>Menambah jumlah dan memperkuat kerjasama dengan kawasan industri dan kawasan ekonomi khusus nasional ataupun asing dan instansi terkait, untuk meningkatkan nilai tawar sekolah ditingkat lokal, regional, nasional dan internasional secara kualitas, baik untuk inputan peserta didik / siswa dan hasil tamatannya</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div><!-- /features -->






                <!-- ============ counter section ============ -
                <div class="section bg-light mb-0">
                    <div class="container clearfix">


                        <div class="row">

                            <div class="col-md-3 col-sm-6 text-center" data-animate="bounceIn" data-delay="800">
                                <i class="fa fa-clock-o fa-5x"></i>
                                <div class="counter"><span data-from="100" data-to="2600" data-refresh-interval="50" data-speed="2000"></span>+</div>
                                <h5>Coding Hours</h5>
                            </div>

                            <div class="col-md-3 col-sm-6 text-center" data-animate="bounceIn" data-delay="1000">
                                <i class="fa fa-code fa-5x"></i>
                                <div class="counter"><span data-from="100" data-to="465" data-refresh-interval="50" data-speed="3200"></span>K+</div>
                                <h5>Lines of Code</h5>
                            </div>

                            <div class="col-md-3 col-sm-6 text-center" data-animate="bounceIn" data-delay="1200">
                                <i class="fa fa-folder-open fa-5x"></i>
                                <div class="counter"><span data-from="100" data-to="340" data-refresh-interval="50" data-speed="3600"></span>*</div>
                                <h5>Templates Done</h5>
                            </div>

                            <div class="col-md-3 col-sm-6 text-center" data-animate="bounceIn" data-delay="1400">
                                <i class="fa fa-users fa-5x"></i>
                                <div class="counter"><span data-from="100" data-to="1950" data-refresh-interval="50" data-speed="2600"></span>+</div>
                                <h5>Satisfied Customers</h5>
                            </div>

                        </div>


                    </div>
                </div> /counter section -->

            </div>
        </section><!-- #content end -->

        <?php $this->view('frontend/footer.php', $footer) ?>

    </div><!-- #wrapper end -->











    <!-- ============================================
    =================== Go to Top ===================
    ============================================= -->

    <div id="gotoTop" class="fa fa-angle-up hidden-md"></div>










    <!-- ============================================
    ============== Vendor JavaScripts ===============
    ============================================= -->

    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/superfish/js/superfish.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/jRespond/jRespond.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/smoothscroll/SmoothScroll.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/appear/jquery.appear.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/stellar/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/flexslider/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/magnific/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/owl/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/jflickrfeed/jflickrfeed.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/tweet-js/jquery.tweet.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/countTo/jquery.countTo.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/morrisjs/raphael-min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/morrisjs/morris.min.js"></script>


    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- animsition js -->
    <script src="<?= ASSETS_URL ?>frontend/js/vendor/animsition/js/jquery.animsition.min.js"></script>







    <!-- ============================================
    ============== Custom JavaScripts ===============
    ============================================= -->


    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/global.js"></script>


</body>
</html>