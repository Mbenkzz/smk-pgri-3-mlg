<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php' ?>
    <?php if(isset($data->berita_title)): ?>
        <script type="text/javascript">
            if (window.XMLHttpRequest) {
            // code for modern browsers
            xhttp = new XMLHttpRequest();
        } else {
            // code for old IE browsers
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.open("POST", "<?= BASE_URL . "berita/send" ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("berita_id=<?=$data->berita_id?>");
    </script>
<?php endif ?>
</head>

<body>
    <!-- ============================================
    ================= Page Wrapper ==================
    ============================================= -->

    <div id="wrapper" class="clearfix animsition">

        <?php $this->view('frontend/header.php', $header) ?>

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
                                    <h2 class="text-uppercase"><?= isset($data->berita_title) ? $data->berita_title : $data->agenda_title ?></h2>
                                </div>

                                <ul class="entry-meta clearfix">
                                    <li><i class="fa fa-calendar-o"></i> <?= time_elapsed_string($data->created_at) ?></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> <?= count($komentar) ?></a></li>
                                    <li><i class="fa fa-tags"></i> <a href="#">Berita</a></li>
                                    <?php if(isset($data->berita_title)): ?>
                                        <li class="pull-right"><i class="fa fa-print"></i> <a href="#" onclick="window.open('<?=BASE_URL . "berita/print/$data->berita_id"?>', '_blank')"><b>CETAK SEBAGAI PDF</b></a>
                                        <?php endif ?>
                                    </ul>

                                    <div class="entry-image">
                                        <img src="<?= getImage(BASE_URL . $data->file_directory) ?>" class="img-responsive" alt="Image">
                                    </div>

                                    <div class="entry-content">
                                        <?= isset($data->berita_description) ? $data->berita_description : $data->agenda_description ?>
                                    </div>

                                    <?php if(isset($data->berita_title)): ?>
                                        <div class="entry-tags">
                                            <ul class="list-unstyled list-inline">
                                                <?php foreach ($post_tag as $value): ?>
                                                    <li><a href="#" class="btn-tag"><?= ucwords($value->hashtag_name) ?></a></li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    <?php endif ?>

                                    <hr class="post-divider">

                                    <?php if(isset($data->berita_id)): ?>
                                        <div class="entry-comments">
                                            <h3><span class="text-theme"><?= count($komentar) ?></span> Comments:</h3>

                                            <ul class="comments-feed">
                                                <?php foreach ($komentar as $key => $value) :
                                                    $reply = !empty($value->reply_to) ? getRepliedComment($var_model, $value->reply_to) : FALSE; 
                                                    ?>
                                                    <li class="comment">

                                                        <div class="comment-body">
                                                            <div class="comment-header">
                                                                <h3 class="comment-author"><?= $value->nama ?></h3>
                                                                <span class="comment-meta"><?= FullDateFormat($value->komentar_date, 'd M Y H:i') ?></span>
                                                                <span class="comment-reply"><a href="#" onclick="$('#reply-to-<?= $value->komentar_id ?>').toggleClass('hidden');"><i class="fa fa-reply"></i></a></span>
                                                            </div>
                                                            <?php if($reply): ?>
                                                                <p class="comment-content" style="margin-left: 2em; background-color: #ffddbb; padding: 1em">
                                                                    <b class=""><?= $reply->nama ?></b> at <?= FullDateFormat($reply->komentar_date, 'd M Y H:i') ?><br><?= $reply->komentar_text ?></p>
                                                                <?php endif ?>
                                                                <p class="comment-content"><?= $value->komentar_text ?></p>
                                                            </div>

                                                            <ul class="comment-replies">
                                                                <li class="comment hidden reply-comment" id="reply-to-<?= $value->komentar_id ?>">
                                                                    <form class="comment-body new_reply">
                                                                        <input type="hidden" name="author_name" value="<?= $value->nama ?>">
                                                                        <input type="hidden" name="author_date" value="<?= FullDateFormat($value->komentar_date, 'd M Y H:i') ?>">
                                                                        <input type="hidden" name="author_text" value="<?= $value->komentar_text ?>">
                                                                        <input type="hidden" name="berita_id" value="<?=$data->berita_id?>">
                                                                        <input type="hidden" name="reply_to" value="<?= $value->komentar_id ?>">
                                                                        <div class="comment-header row">
                                                                            <h3 class="comment-author" style="margin-left: 1.5rem">Balas Komentar</h3>
                                                                            <div class="col-md-4 form-group">
                                                                                <label>Nama</label>
                                                                                <input type="text" name="name" class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 form-group">
                                                                                <label>Email</label>
                                                                                <input type="email" name="email" class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 form-group">
                                                                                <label>Website</label>
                                                                                <input type="url" name="web" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="comment-content row">
                                                                            <div class="col-md-12 form-group">
                                                                                <label>Komentar</label>
                                                                                <textarea name="comment" rows="6" class="form-control"></textarea>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <button type="submit" class="btn btn-warning">
                                                                                    Kirim
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>



                                            <hr class="post-divider">


                                            <h3 class="mt-40"><span class="text-theme">Komentar</span> Baru:</h3>

                                            <form id="new_comment">
                                                <input type="hidden" name="berita_id" value="<?=$data->berita_id?>">

                                                <div class="row">

                                                    <div class="form-group col-sm-4">
                                                        <label for="name">Nama <span class="text-lightred" style="font-size: 15px">*</span></label>
                                                        <input name="name" type="text" class="form-control myInput" id="name" required>
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="email">Email</label>
                                                        <input name="email" type="email" class="form-control myInput" id="email">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="web">Website</label>
                                                        <input name="web" type="text" class="form-control myInput" id="web">
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-sm-12">
                                                        <label for="comment">Komentar <span class="text-lightred" style="font-size: 15px">*</span></label>
                                                        <textarea name="comment" class="form-control myInput" id="comment" rows="8" required></textarea>
                                                    </div>

                                                </div>

                                                <button type="submit" class="myBtn myBtn-rounded myBtn-3d m-0 mt-10">Kirim</button>


                                            </form>
                                        <?php endif; ?>

                                    </article>



                                </div>
                                <!-- END BLOG POSTS -->

                                <!-- BLOG SIDEBAR -->
                                <div class="col-sm-3 sidebar">

                                    <?php if(isset($data->berita_title)): ?>
                                        <!-- RECENT POSTS -->
                                        <h4 class="widget-heading">Recent Posts</h4>
                                        <ul class="media-list recent-posts sidebar-widget">
                                            <?php foreach ($recent_post as $key => $value) :?>
                                                <li class="media">
                                                    <div class="media-left">
                                                        <a href="<?= BASE_URL."berita/$value->berita_id" ?>">
                                                            <img class="media-object fit" alt="" src="<?= getImage(BASE_URL. $value->file_directory) ?>">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading" title="<?= $value->berita_title ?>"><a href="<?= BASE_URL."berita/$value->berita_id" ?>"><?= convertToText($value->berita_title, 40) ?></a></h5>
                                                        <p><?= convertToText($value->berita_description, 100) ?></p>
                                                    </div>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                        <!-- END RECENT POSTS -->

                                        <!-- RECENT POSTS -->
                                        <h4 class="widget-heading">Related Posts</h4>
                                        <ul class="media-list recent-posts sidebar-widget">
                                            <?php foreach ($related_post as $key => $value) :?>
                                                <li class="media">
                                                    <div class="media-left">
                                                        <a href="<?= BASE_URL."berita/$value->berita_id" ?>">
                                                            <img class="media-object" alt="" src="<?= getImage(BASE_URL. $value->file_directory) ?>">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading" title="<?= $value->berita_title ?>"><a href="<?= BASE_URL."berita/$value->berita_id" ?>"><?= convertToText($value->berita_title, 40) ?></a></h5>
                                                        <p><?= convertToText($value->berita_description, 100) ?></p>
                                                    </div>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                        <!-- END RECENT POSTS -->

                                        <!-- TAGS -->
                                        <h4 class="widget-heading">Tags</h4>
                                        <ul class="tags sidebar-widget list-unstyled list-inline">
                                            <?php foreach ($post_tag as $key => $value): ?>
                                                <li><a href="<?= BASE_URL . "news?tags=$value->hashtag_name" ?>" class="btn-tag"><i class="fa fa-tags"></i> <?= ucwords($value->hashtag_name) . " ($value->jumlah)" ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                        <!-- END TAGS -->
                                    <?php endif ?>

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
    <?php if(isset($data->berita_id)): ?>
        <script type="text/javascript">
            var today = new Date();
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            $('[href=#]').click(function(event) {
                event.preventDefault();
            });

            $("#new_comment").submit(function(e){
                var form = this;
                e.preventDefault();
                $.ajax({
                    url: "<?= BASE_URL ?>comment",
                    processData: false,
                    contentType: false,
                    cache: false,
                    type: "POST",
                    data : new FormData(form),
                    success: function(response){
                        if(response == "success") {
                            var date = today.getDate()+' '+(months[today.getMonth()])+' '+today.getFullYear();
                            var time = today.getHours() + ":" + today.getMinutes();
                            $('.comments-feed').append(`<li class="comment">

                                <div class="comment-body">
                                <div class="comment-header">
                                <h3 class="comment-author">${document.getElementById('name').value}</h3>
                                <span class="comment-meta">${date} ${time}</span>
                                <span class="comment-reply"><a href="#"><i class="fa fa-reply"></i></a></span>
                                </div>
                                <p class="comment-content">${document.getElementById('comment').value}</p>
                                </div>

                                </li>`);

                            form.reset();
                            alert("Kirim komentar sukses");
                        } else {
                            alert(response);
                        }
                    }
                });
            });

            $(".new_reply").submit(function(e){
                e.preventDefault();
                var form = this;
                var name = $(form).find('[name="name"]');
                var email = $(form).find('[name="email"]');
                var web = $(form).find('[name="web"]');
                var comment = $(form).find('[name="comment"]');

                var author_name = $(form).find('[name="author_name"]');
                var author_date = $(form).find('[name="author_date"]');
                var author_text = $(form).find('[name="author_text"]');

                $.ajax({
                    url: "<?= BASE_URL ?>comment",
                    processData: false,
                    contentType: false,
                    cache: false,
                    type: "POST",
                    data : new FormData(form),
                    success: function(response){
                        if(response == "success") {
                            var date = today.getDate()+' '+(months[today.getMonth()])+' '+today.getFullYear();
                            var time = today.getHours() + ":" + checkTime(today.getMinutes());
                            
                            $('.comments-feed').append(`<li class="comment">

                                <div class="comment-body">
                                <div class="comment-header">
                                <h3 class="comment-author">${name.val()}</h3>
                                <span class="comment-meta">${date} ${time}</span>
                                </div>
                                <p class="comment-content" style="margin-left: 2em; background-color: #ffddbb; padding: 1em">
                                <b class="">${author_name.val()}</b> at ${author_date.val()}<br> ${author_text.val()} </p>
                                <p class="comment-content">${comment.val()}</p>
                                </div>

                                </li>`);
                            $("li.reply-comment:not(.hidden)").addClass('hidden');
                            form.reset();

                        } else {
                            alert(response);
                        }
                    }
                });
            });

            function checkTime(i) {
              if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    </script>
<?php endif; ?>

</body>
</html>