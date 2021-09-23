
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php' ?>
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
        <section id="breadcrumbs" class="breadcrumbs">

            <div class="container clearfix">
                <span>Departemen</span>
                <h1><?= $departemen->name ?></h1>
            </div>

        </section><!-- #breadcrumbs end -->










        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="row">


                        <!-- BLOG POST -->
                        <div class="col-sm-9 blog-post">


                            <article class="post-entry">
                                <?php if($departemen->file): ?>
                                <div class="entry-image">
                                    <img src="<?= $departemen->file ?>" class="img-responsive">
                                </div>
                                <?php endif ?>

                                <div class="entry-content">
                                    <p><?= $departemen->description ?></p>
                                    
                                </div>

                                <hr class="post-divider">

                            </article>



                        </div>
                        <!-- END BLOG POSTS -->

                        <!-- BLOG SIDEBAR -->
                        <div class="col-sm-3 sidebar">

                            <!-- CATEGORIES -->
                            <h4 class="widget-heading">Bidang Keahlian</h4>
                            <ul class="nav categories sidebar-widget">
                                <?php foreach ($departemen->jurusan as $key => $value): ?>
                                <li><a href="<?= BASE_URL . "jurusan/$value->jurusan_id" ?>"><i class="fa fa-angle-right mr-5"></i> <?= $value->jurusan_name ?></a></li>
                                <?php endforeach ?>
                            </ul>
                            <!-- END CATEGORIES -->

                        </div>
                        <!-- END BLOG SIDEBAR -->

                    </div><!-- blog -->


                </div>

            </div>
        </section><!-- #content end -->

        <?php $this->view('frontend/footer', $footer) ?>

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