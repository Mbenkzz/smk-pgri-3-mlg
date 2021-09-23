
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />





    <!-- ============================================
    ================= Stylesheets ===================
    ============================================= -->

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic|Raleway:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/js/vendor/flexslider/flexslider.css" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/js/vendor/magnific/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/js/vendor/owl/owl.carousel.css" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/js/vendor/owl/owl.theme.css" type="text/css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/js/vendor/morrisjs/morris.css" type="text/css" />

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?= ASSETS_URL ?>frontend/js/vendor/rs-plugin/css/settings.css" media="screen" />

    <!-- animsition CSS -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/js/vendor/animsition/css/animsition.min.css">



    <!-- jQuery -->
    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/vendor/jquery-1.11.2.min.js"></script>






    <!-- ============================================
    ============= Main App Stylesheet ===============
    ============================================= -->

    <link rel="stylesheet" href="<?= ASSETS_URL ?>frontend/css/style.css" type="text/css" />







    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
    	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->









    <!-- ============================================
    ================== Page Title ===================
    ============================================= -->

    <title>Preview</title>







</head>

<body>








    <!-- ============================================
    ================= Page Wrapper ==================
    ============================================= -->

    <div id="wrapper" class="clearfix animsition">

                <!-- ============================================
        ==================== Header =====================
        ============================================= -->

        <header id="header" class="transparent-header dark"><!-- class .sticky-mobile makes header sticky on small devices -->

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="main-navbar-toggle"><i class="fa fa-bars"></i></div>

                    <!-- ============================================
                    =================== Branding ====================
                    ============================================= -->

                    <div id="branding">
                        <a href="#" class="brand-normal" data-light-logo="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png"><img src="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png" alt="Minovate"></a>
                        <a href="#" class="brand-retina" data-light-logo="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png"><img src="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png" alt="Minovate"></a>
                    </div><!-- #branding end -->

                    <!-- ============================================
                    ================= Main Navbar ===================
                    ============================================= -->

                    <nav id="main-navbar">

                        <ul>
                            <li class="active"><a href="#">Preview</a></li>
                            <li><a href="<?= BASE_URL . "admin-ea/$jenis" ?>"><?= $jenis ?></a></li>
                            <?php if(!$data->isapprove): ?>
                                <li><a href="<?= BASE_URL . "admin-ea/$jenis/edit/$data->id" ?>">Kembali ke Edit</a></li>
                            <?php endif ?>
                            
                        </ul>

                        <?php if($_SESSION['role'] == "ADMIN") : ?>
                        <?php if(!$data->isapprove) : ?>
                            <div id="search-toggle"> <span>|</span> <a href="#" role="button" data-toggle="modal" data-target="#modal-approve" data-backdrop="static"><b>APPROVE</b></a> </div>
                            <?php elseif (strtolower($jenis) == "berita") : ?>
                                <div id="search-toggle"> <span>|</span> <a href="#" onclick="window.open('<?= BASE_URL . "admin-ea/$jenis/print/$data->id"?>', '_blank')"><i class="fa fa-print mr-1"></i> Print</a> </div>
                            <?php endif ?>
                        <?php endif ?>
                        </nav><!-- #main-navbar end -->

                    </div>

                </div>

            </header><!-- #header end -->

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

                                <div class="entry-title">
                                    <h2 class="text-uppercase">[PREVIEW] <?= $data->title ?></h2>
                                </div>

                                <ul class="entry-meta clearfix">
                                    <li><i class="fa fa-calendar-o"></i> <?= time_elapsed_string($data->updated_at) ?></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 0</a></li>
                                </ul>

                                <div class="entry-image">
                                    <img src="<?= getImage(BASE_URL.$data->file_directory) ?>" class="img-responsive" alt="Image">
                                </div>

                                <div class="entry-content"><?= $data->description ?></div>

                            </article>



                        </div>
                        <!-- END BLOG POSTS -->

                        <!-- BLOG SIDEBAR -->
                        <div class="col-sm-3 sidebar">
                            <!-- RECENT POSTS -->
                            <h4 class="widget-heading">Preview Recent Post</h4>
                            <ul class="media-list recent-posts sidebar-widget">

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object" alt="" src="<?= getImage("assets/images/portfolio/castles-616573_1280.jpg") ?>">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="blog-item.html">Lorem Ipsum dolor sit amet</a></h5>
                                        <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.</p>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object" alt="" src="<?= getImage("assets/images/portfolio/castles-616573_1280.jpg") ?>">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="blog-item.html">Lorem Ipsum dolor sit amet</a></h5>
                                        <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.</p>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object" alt="" src="<?= getImage("assets/images/portfolio/castles-616573_1280.jpg") ?>">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="blog-item.html">Lorem Ipsum dolor sit amet</a></h5>
                                        <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.</p>
                                    </div>
                                </li>

                            </ul>
                            <!-- END RECENT POSTS -->
                        </div>
                        <!-- END BLOG SIDEBAR -->

                    </div><!-- blog -->

                </div>

            </div>
        </section><!-- #content end -->

<!-- ===========================================
        ==================== Footer =====================
        ============================================= -->

        <footer id="footer">

            <div class="footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 copyright">
                            <p class="mb-0">&copy; Copyright <script>document.write(new Date().getFullYear())</script> <a href="#">SMK PGRI 3 Malang</a>. All Rights Reserved.</p>
                            <p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer><!-- #footer end -->

        </div><!-- #wrapper end -->

    <!-- ============================================
    ===================== Modal =====================
    ============================================= -->
            <?php if(!$data->isapprove && $_SESSION['role'] == "ADMIN"): ?>
            <div class="modal fade" id="modal-approve">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Approve</h4>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin akan meng-Approve <?= $jenis ?> ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn" id="submit-approve" onclick="approve(<?= $data->id ?>)">APPROVE</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?php endif ?>

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

    <?php if(!$data->isapprove && $_SESSION['role'] == "ADMIN"): ?>
    <script type="text/javascript">
        function approve(id) {
            $("#submit-approve").attr('onclick', '');
            $("#submit-approve").prev("").attr('onclick', '');
            $("#submit-approve").html("APPROVE <i class=\"fa fa-spinner fa-spin mx-2\"></i>");
            $.ajax({
                url: '<?= BASE_URL . "admin-ea/$jenis/approve" ?>',
                type: 'POST',
                data: {value_id: id},
                success: function(res) {
                    var res = eval(`(${res})`);
                    $("#submit-approve").html("<i class=\"fa fa-check mr-2\"></i> SUKSES");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        }
    </script>
    <?php endif ?>


</body>
</html>