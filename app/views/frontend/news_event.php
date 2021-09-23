
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

        <section id="breadcrumbs" class="breadcrumbs">

            <div class="container clearfix">
                <h1><?= strtoupper($jenis) ?></h1>
                <span><?= ucfirst($jenis) ?> SMK PGRI 3 Malang</span>
                <ol class="breadcrumb">
                    <li><a href="#">News and Event</a></li>
                    <li class="active"><?= ucfirst($jenis) ?></li>
                </ol>
            </div>

        </section>

        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="row">


                        <!-- BLOG POSTS -->
                        <div class="col-sm-9 blog-posts">

                            <?php if(strtolower($jenis) == "berita"): ?>
                                <form class="row" id="filter_form">
                                    <fieldset class="col-md-4 form-group">
                                        <label style="width: 100%">Filter</label>
                                        <select class="form-control" id="filter_type" onchange="filter()">
                                            <option value="new" <?= getGet("sort") != "popular" ? "selected" : "" ?>>Terbaru</option>
                                            <option value="popular" <?= getGet("sort") == "popular" ? "selected" : "" ?>>Banyak dilihat</option>
                                        </select>
                                    </fieldset>
                                    <fieldset class="col-md-4 form-group  <?= getGet("sort") != "popular" ? "hidden" : "" ?>">
                                        <label style="width: 100%; color: transparent">A</label>
                                        <select class="form-control" id="filter_range" onchange="filter()">
                                            <option value="week" <?= getGet("range") == "week" ? "selected" : "" ?>>Mingguan</option>
                                            <option value="month" <?= getGet("range") == "month" ? "selected" : "" ?>>Bulanan</option>
                                            <option value="year" <?= getGet("range") == "year" ? "selected" : "" ?>>Tahunan</option>
                                            <option value="all" <?= getGet("range") == "all" ? "selected" : "" ?>>Semua</option>
                                        </select>
                                    </fieldset>
                                    <fieldset class="col-md-4 form-group">
                                        <label style="width: 100%; color: transparent">A</label>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </fieldset>
                                </form>
                            <?php endif ?>

                            <?php foreach ($data["ARRAY"] as $key => $value): ?>
                                <article class="post-entry">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="entry-image">
                                                <a href="<?= BASE_URL.$jenis."/$value->id" ?>"><img src="<?= getImage(BASE_URL . $value->file_directory) ?>" class="img-responsive fit" alt="Image"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">                                            
                                            <div class="entry-title">
                                                <h2 class="text-uppercase"><a href="<?= BASE_URL.$jenis."/$value->id" ?>"><?= convertToText(isset($value->berita_title) ? $value->berita_title : $value->agenda_title, 60) ?></a></h2>
                                            </div>

                                            <ul class="entry-meta clearfix">
                                                <li><i class="fa fa-calendar-o"></i> <?= time_elapsed_string($value->created_at) ?></li>
                                                <li><a href="#"><i class="fa fa-comments"></i> <?= isset($value->berita_title) ? count(getComment($model, $value->id)) : 0 ?></a></li>
                                            </ul>

                                            <div class="entry-content">

                                                <p><?= convertToText(isset($value->berita_description) ? $value->berita_description : $value->agenda_description, 250) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </article>

                                <hr class="post-divider">

                            <?php endforeach ?>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 text-center">
                                    <ul class="pagination myPagination"><?= $data["PAGINATION_HTML"] ?></ul>
                                </div>
                                <div class="col-md-2"></div>
                            </div>

                        </div>
                        <!-- END BLOG POSTS -->

                        <?php if(strtolower($jenis) == "berita"): ?>
                            <div class="col-sm-3">
                                <!-- TAGS -->
                                <h4 class="widget-heading">Tags</h4>
                                <ul class="tags sidebar-widget list-unstyled list-inline">
                                    <?php foreach ($hashtag as $key => $value): ?>
                                        <li><a href="<?= BASE_URL . "news".$params."tags=$value->hashtag_name" ?>" class="btn-tag"><i class="fa fa-tags"></i> <?= ucwords($value->hashtag_name) . " ($value->jumlah)" ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                                <!-- END TAGS -->
                            </div>
                        <?php endif ?>

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

    <script type="text/javascript">

        var type = document.getElementById('filter_type');
        var range = document.getElementById('filter_range');
        function filter() {

            if(type.value == "new") {
                // Terbaru dipilih
                range.parentElement.classList.add('hidden');
            } else if(type.value == "popular") {
                // Populer Dipilih
                range.parentElement.classList.remove('hidden');
            }
        }

        $("#filter_form").submit(function(event) {
            event.preventDefault();

            if(type.value == "new") {
                // Terbaru dipilih
                window.location.href = `<?= BASE_URL ?>news?sort=new<?= isset($_GET['tags']) ? "&tags=".$_GET['tags'] : "" ?>`;
            } else if(type.value == "popular") {
                // Populer Dipilih
                window.location.href = `<?= BASE_URL ?>news?sort=popular&range=${range.value}<?= isset($_GET['tags']) ? "&tags=".$_GET['tags'] : "" ?>`;
            }
        });
    </script>





    <!-- ============================================
    ============== Custom JavaScripts ===============
    ============================================= -->


    <script type="text/javascript" src="<?= ASSETS_URL ?>frontend/js/global.js"></script>


</body>
</html>