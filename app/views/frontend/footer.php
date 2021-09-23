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

                        <div class="col-md-8 text-right text-center-md">
                            <?php if(!empty($social->facebook->sosmed_akuntautan)):?>
                            <a class="social-icon social-facebook" href="<?= $social->facebook->sosmed_akuntautan ?>" title="Facebook" target="_blank">
                                 <div class="front">
                                    <i class="fa fa-facebook"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-facebook"></i>
                                 </div>
                            </a>
                            <?php endif ?>
                            <?php if(!empty($social->twitter->sosmed_akuntautan)):?>
                            <a class="social-icon social-twitter" href="<?= $social->twitter->sosmed_akuntautan ?>" title="Twitter" target="_blank">
                                 <div class="front">
                                    <i class="fa fa-twitter"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-twitter"></i>
                                 </div>
                            </a>
                            <?php endif ?>
                            <?php if(!empty($social->google->sosmed_akuntautan)):?>
                            <a class="social-icon social-googleplus" href="<?= $social->google->sosmed_akuntautan ?>" title="Google +" target="_blank">
                                 <div class="front">
                                    <i class="fa fa-google-plus"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-google-plus"></i>
                                 </div>
                            </a>
                            <?php endif ?>
                            <?php if(!empty($social->pinterest->sosmed_akuntautan)):?>
                            <a class="social-icon social-pinterest" href="<?= $social->pinterest->sosmed_akuntautan ?>" title="Pinterest" target="_blank">
                                 <div class="front">
                                    <i class="fa fa-pinterest"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-pinterest"></i>
                                 </div>
                            </a>
                            <?php endif ?>
                            <?php if(!empty($social->instagram->sosmed_akuntautan)):?>
                            <a class="social-icon social-instagram"  href="<?= $social->instagram->sosmed_akuntautan ?>"title="Instagram" target="_blank">
                                 <div class="front">
                                    <i class="fa fa-instagram"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-instagram"></i>
                                 </div>
                            </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- #footer end -->