
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
        <section id="breadcrumbs">

            <div class="container clearfix">
                <h1>Kontak Kami</h1>
                <!--<span>Stay in Touch with Us!</span>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Contact Us</li>
                </ol>-->
            </div>

        </section><!-- #breadcrumbs end -->

        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">


            <!-- ============ Gmap section ============ -->
            <div class="section gMap m-0" id="google-map">


                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyA2HXlykzLZR_wlAdI5h5gtaVL9HZWCr1w"></script>
                <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/gMap/jquery.gmap.min.js"></script>

                <script type="text/javascript">

                    $('#google-map').gMap({
                        maptype: 'ROADMAP',
                        latitude: -7.927264,
                        longitude: 112.602105,
                        zoom: 18,
                        icon: {
                            image: "http://www.google.com/mapfiles/marker.png",
                            shadow: "http://www.google.com/mapfiles/shadow50.png",
                            iconsize: [20, 34],
                            shadowsize: [37, 34],
                            iconanchor: [9, 34],
                            shadowanchor: [19, 34]
                        },
                        doubleclickzoom: false,
                        controls: {
                            panControl: true,
                            zoomControl: true,
                            mapTypeControl: true,
                            scaleControl: false,
                            streetViewControl: false,
                            overviewMapControl: false
                        }

                    });

                    $('#google-map').gMap('addMarker', { latitude: 48.1512724, longitude: 17.1215819, content: 'Some HTML content' });

                </script><!-- Google Map End -->


            </div><!-- /Gmap section -->


            <div class="content-wrap">

                <!-- ============ Contact section ============ -->
                <div class="container clearfix">

                    <div class="row">

                        <div class="col-md-8">

                            <div class="heading-block mb-60">
                                <h2 class="text-uppercase"><span class="text-theme">Give us</span> a line</h2>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div>
                                <h3 class="text-uppercase">Lokasi</h3>

                                <address>
                                    <strong class="text-theme">SMK PGRI 3 Malang</strong><br>
                                    Jl Raya Tlogomas IX/29<br>
                                    Kota Malang<br>

                                    <!-- <strong class="block mt-20">Phone:</strong>
                                    CEO: +421 02 66 55 12<br>
                                    Support: +421 02 66 55 13 -->

                                    <!-- <strong class="block mt-20">Email:</strong>
                                    <a href="#">ici.kamarel@tattek.sk</a><br>
                                    <a href="#">support@tattek.sk</a> -->

                                </address>

                                <h3 class="text-uppercase">Jam <span class="text-theme">Aktif</span></h3>

                                <address>
                                    <strong>Senin - Jumat:</strong> 7:00 - 15:00<br>
                                    <strong>Sabtu - Minggu:</strong> Libur<br>
                                </address>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- ============ /Contact section ============ -->

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