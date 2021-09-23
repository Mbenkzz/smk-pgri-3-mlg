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

        <!-- ================================================
        ================= Search Container ==================
        ================================================= -->

        <!--<div id="search-container" class="search-box-wrapper">
            <div class="container">
                <i class="fa fa-search"></i>
                <div class="search-box">
                    <form action="http://example.com/" class="search-form" role="search" >
                        <input type="search" name="s" value="" title="Press Enter to submit your search" placeholder="Search…" class="search-field">
                        <input type="submit" value="Search" class="search-submit">
                    </form>
                </div>
            </div>
        </div><!--/ #search-container -->

        <?php $this->view('frontend/header.php', $header) ?>

        <!-- ============================================
        ==================== Slider =====================
        ============================================= -->

        <section id="slider" class="slider-parallax">

            <!--
            #################################
                - THEMEPUNCH BANNER -
            #################################
        -->

        <div class="tp-banner-container">

            <div class="tp-banner" >

                <ul>

                    <!-- SLIDE  -->
                    <li class="light" data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="<?= ASSETS_URL ?>images/main_page/sample1.jpg">

                        <!-- MAIN IMAGE -->
                        <img src="<?= ASSETS_URL ?>images/main_page/sample1.jpg" alt="" data-bgposition="right center" data-kenburns="on" data-duration="8000" data-ease="Linear.easeNone" data-bgfit="150" data-bgfitend="100" data-bgpositionend="center center">

                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                            <!-- <div class="tp-caption black_thin_blackbg_30 lft fadeout"
                                data-x="120"
                                data-y="220"
                                data-speed="800"
                                data-start="1000"
                                data-easing="easeOutQuad"
                                data-endspeed="1000"
                                data-endeasing="Power4.easeIn" style="white-space: normal;">
                                This is caption
                            </div> -->

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption big-text text-white skewfromleft fadeout"
                            data-x="350"
                            data-y="300"
                            data-speed="800"
                            data-start="1000"
                            data-easing="easeOutQuad"
                            data-endspeed="1000"
                            data-endeasing="Power4.easeIn">Success by Discipline
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption light_normal_22 text-center skewfromright fadeout"
                        data-x="210"
                        data-y="400"
                        data-speed="800"
                        data-start="1000"
                        data-easing="easeOutQuad"
                        data-endspeed="1000"
                        data-endeasing="Power4.easeIn" style="width: 680px; max-width: 680px; white-space: normal;">
                    </div>

                    <!-- LAYER NR. 4 -->
                    <div class="tp-caption lfb fadeout"
                    data-x="480"
                    data-y="560"
                    data-speed="800"
                    data-start="1000"
                    data-easing="easeOutQuad"
                    data-endspeed="1000"
                    data-endeasing="Power4.easeIn"><a href="#" class="myBtn myBtn-border myBtn-light myBtn-rounded text-sm"><span>Learn More</span> <i class="fa fa-angle-right"></i></a>
                </div>


            </li>

            <!-- SLIDE  -->
            <li class="light" data-transition="slideup" data-slotamount="1" data-masterspeed="1000" data-thumb="<?= ASSETS_URL ?>images/main_page/sample2.jpg">

                <!-- MAIN IMAGE -->
                <img src="<?= ASSETS_URL ?>images/main_page/sample2.jpg"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">

                <!-- LAYERS -->

                <!-- LAYER NR. 1 -->
                <div class="tp-caption white_heavy_70 tp-fade fadeout"
                data-x="center" data-hoffset="-80"
                data-y="center" data-voffset="0"
                data-speed="500"
                data-start="500"
                data-easing="Power4.easeOut"
                data-splitin="chars"
                data-splitout="chars"
                data-elementdelay="0.05"
                data-endelementdelay="0.05"
                data-endspeed="300"
                data-endeasing="Power1.easeOut"style="z-index: 6; white-space: nowrap;">This is SKARIGA
            </div>

            <!-- LAYER NR. 2 -->
            <div class="tp-caption whiteline_long customin fadeout"
            data-x="center" data-hoffset="0"
            data-y="center" data-voffset="50"
            data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="500"
            data-start="500"
            data-easing="Power4.easeOut"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.1"
            data-endelementdelay="0.1"
            data-endspeed="600"
            data-endeasing="Power1.easeOut"style="z-index: 7; white-space: nowrap;">
        </div>

        <!-- LAYER NR. 3 -->
        <div class="tp-caption light_medium_20 tp-fade fadeout"
        data-x="center" data-hoffset="-31"
        data-y="center" data-voffset="120"
        data-speed="600"
        data-start="800"
        data-easing="Power4.easeOut"
        data-splitin="none"
        data-splitout="none"
        data-elementdelay="0.1"
        data-endelementdelay="0.1"
        data-endspeed="600"
        data-endeasing="Power1.easeOut"style="z-index: 8; white-space: nowrap;">“Sekolah untuk Kerja, Wirausaha. Kuliah apalagi”
    </div>

</li>

</ul>

</div>

<script type="text/javascript">

    $(document).ready(function() {

        var apiRevoSlider = $('.tp-banner').show().revolution(
        {
            dottedOverlay:"none",
            delay:9000,
            startwidth:1140,
            startheight:700,
            hideThumbs:200,

            thumbWidth:100,
            thumbHeight:50,
            thumbAmount:3,

            navigationType:"none",
            navigationArrows:"solo",
            navigationStyle:"preview1",

            touchenabled:"on",
            onHoverStop:"on",

            swipe_velocity: 0.7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: false,


            parallax:"mouse",
            parallaxBgFreeze:"on",
            parallaxLevels:[8,7,6,5,4,3,2,1],
            parallaxDisableOnMobile:"on",


            keyboardNavigation:"on",

            navigationHAlign:"center",
            navigationVAlign:"bottom",
            navigationHOffset:0,
            navigationVOffset:20,

            soloArrowLeftHalign:"left",
            soloArrowLeftValign:"center",
            soloArrowLeftHOffset:20,
            soloArrowLeftVOffset:0,

            soloArrowRightHalign:"right",
            soloArrowRightValign:"center",
            soloArrowRightHOffset:20,
            soloArrowRightVOffset:0,

            shadow:0,
            fullWidth:"off",
            fullScreen:"on",

            spinner:"spinner3",

            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,

            shuffle:"off",

            forceFullWidth:"off",
            fullScreenAlignForce:"off",
            minFullScreenHeight:"400",

            hideThumbsOnMobile:"off",
            hideNavDelayOnMobile:1500,
            hideBulletsOnMobile:"off",
            hideArrowsOnMobile:"off",
            hideThumbsUnderResolution:0,

            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            startWithSlide:0,
            fullScreenOffsetContainer: ".header"
        });

        apiRevoSlider.bind("revolution.slide.onchange",function (e,data) {
            if( $(window).width() > 992 ) {
                if( $('#slider ul > li').eq(data.slideIndex-1).hasClass('light') ){
                    $('#header:not(.sticky-header)').addClass('light');
                } else {
                    $('#header:not(.sticky-header)').removeClass('light');
                }
                MINOVATE.header.chooseLogo();
            }
        });

                    }); //ready

                </script>

            </div>
            <!-- END REVOLUTION SLIDER -->


        </section><!-- #slider end -->

        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">

            <div class="content-wrap">

                <!--<div class="container clearfix">

                    <div class="row">

                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-check"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="200">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-arrows"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="400">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-globe"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="600">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-book"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="800">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-cog"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="1000">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-info-circle"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="1200">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-puzzle-piece"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="1600">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-support"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-box fadeIn animated" data-animate="fadeIn" data-delay="1800">
                                <div class="heading">
                                    <a href="#"><i class="text-greensea fa fa-send"></i></a>
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure.</p>
                            </div>
                        </div>

                    </div>
                </div>-->

                <div class="section m-0">
                    <div class="container clearfix">

                        <div class="row">




                            <!-- ============ posts section ============ -->
                            <div class="col-12">

                                <div class="header-line">
                                    <h4>Berita Terbaru</h4>
                                </div>

                                <div class="row">
                                    <?php foreach ($berita as $key => $value) :?>

                                        <div class="col-sm-4">

                                            <article class="post-entry">

                                                <div class="entry-image">
                                                    <a href="#"><img src="<?= getImage(BASE_URL . $value->file_directory) ?>" class="img-responsive fit" alt="Image"></a>
                                                </div>

                                                <div class="entry-title">
                                                    <h3><a href="#"><?= $value->berita_title ?></a></h3>
                                                </div>

                                                <ul class="entry-meta clearfix">
                                                    <li><i class="fa fa-calendar-o"></i> <?= time_elapsed_string($value->created_at) ?></li>
                                                    <li><a href="#"><i class="fa fa-comments"></i> 0</a></li>
                                                </ul>

                                                <div class="entry-content">
                                                    <p><?= convertToText($value->berita_description, 100) ?></p>
                                                </div>

                                                <a href="" class="plus"></a>

                                            </article>

                                        </div>
                                    <?php endforeach; ?>

                                </div><!-- /posts section -->




                                <!-- ============ feedback section ============ -->
                                <!-- /feedback section -->








                            </div>
                        </div>


                    </div>
                </div>


                <!-- ============ clients carousel section ============ -->
                <div id="clients-carousel" class="section owl-carousel carousel-full m-0 pb-0">

                    <?php foreach ($partner as $key => $value) : ?>
                        <div class="carousel-item center-block"><a href="#" class="desaturate center-block"><img src="<?= BASE_URL.$value->file_directory ?>" class="img-responsive center-block" style="max-height: 50px" alt="<?= $value->partner_name ?>" value="<?= $value->partner_name ?>"></a></div>
                    <?php endforeach ?> 
                    

                </div><!-- /clients carousel section -->


                <script type="text/javascript">

                    $(document).ready(function() {

                        var cCarousel = $("#clients-carousel");

                        cCarousel.owlCarousel({
                            loop: true,
                            nav: false,
                            autoPlay: 3000,
                            autoplayHoverPause: true,
                            pagination: false,
                            responsive:{
                                0:{ items:1 },
                                600:{ items:2 },
                                1000:{ items:3 },
                                1200:{ items:4 },
                                1400:{ items:5 }
                            }
                        });


                    }); //ready

                </script>



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