<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Shy Design">
        <!-- Le styles -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">
        <link href="/css/font-awesome.css" rel="stylesheet">
        <!--[if IE 7]>
        <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <![endif]-->
        <style type="text/css">
            #header{
                background: url('http://d2qcctj8epnr7y.cloudfront.net/images/jayson/photostr-image4.jpg') no-repeat;
                background-size: cover;
                background-attachment: scroll;
                background-position: center;
            }
            .header-description h2{
                line-height: normal;
                font-weight: 300;
                font-size:65px;
                text-shadow: 3px 2px 2px rgb(219, 82, 47);
            }
            .container-ul{
                height: 90px;
            }
            .feature-ul-social{
                display: none;
                overflow: hidden;
            }
            .ftr-social-wrap{
                height: 90px;
                width: 90px;
                position: relative;
                transition: all 1.6s linear 0s;
            }
            .wrapEffect{
                position: absolute;
                width: 90px;
                height: 90px;
                transition: all 1.6s linear 0s;
                left: 0;
                top: 0;
            }
            .ss1,.ss5,.ss6,.ss2,.ss3,.ss4{
                opacity: 1;
                transition: all 1.6s linear 0s;
            }
            .ss1.s1,.ss2.s2,.ss3.s3,.ss4.s4,.ss5.s5,.ss6.s6{
                opacity: 0.5;
                transition: all 1.6s linear 0s;
            }
            .ss1.s1 {
                left: 260px;
                z-index: 6;
                transition: all 1.6s linear 0s;
            }
            .ss2.s2 {
                left: -216px;
                z-index: 5;
                transition: all 1.6s linear 0s;
            }
            .ss3.s3 {
                left: 172px;
                z-index: 4;
                transition: all 1.6s linear 0s;
            }
            .ss4.s4 {
                left: -131px;
                z-index: 3;
                transition: all 1.6s linear 0s;
            }
            .ss5.s5 {
                left: 72px;
                z-index: 2;
                transition: all 1.6s linear 0s;
            }
            .ss6.s6 {
                left:-32px;
                z-index: 1;
                transition: all 1.6s linear 0s;
            }
        </style>
    </head>
    <body>
        <header id="header" class="site-header">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <h1>
                            <a class="site-title pull-left tip_trigger" href="#">
                                <img src="/img/logo-photostream.png" alt="PhotoStream" style="height:35px;">
                                <span class="tip">Join, Love and Share Photo Stream.</span>
                            </a>
                        </h1>
                        <div class="user text-right">
                            <a class="user-login" href="<?php echo base_url()?>login"> Login</a> |
                            <a class="user-regidter" href="<?php echo base_url()?>signup">Register</a>
                        </div>
                    </div><!-- /span12 -->
                </div><!-- /row-fluid -->
            </div><!-- /container -->
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="header-description">
                            <h2>
                                Stream your Social Photos<br>and Create Challenges
                            </h2>
                            <div class="container-ul">
                                <ul id="feature-ul-social" class="inline feature-ul-social">
                                    <li>
                                        <div class="ftr-social-wrap">
                                            <div class="wrapEffect sf1 ss1 s1">
                                                <img src="http://d2qcctj8epnr7y.cloudfront.net/images/jayson/photostream/Facebook-icon.png">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ftr-social-wrap">
                                            <div class="wrapEffect sf3 ss3 s3">
                                                <img src="http://d2qcctj8epnr7y.cloudfront.net/images/jayson/photostream/Instagram-icon.png">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ftr-social-wrap">
                                            <div class="wrapEffect sf5 ss5 s5">
                                                <img src="http://d2qcctj8epnr7y.cloudfront.net/images/jayson/photostream/Flickr-icon.png">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ftr-social-wrap">
                                            <div class="wrapEffect sf6 ss6 s6">
                                                <img src="http://d2qcctj8epnr7y.cloudfront.net/images/jayson/photostream/Google-Plus-icon.png">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ftr-social-wrap">
                                            <div class="wrapEffect sf4 ss4 s4">
                                                <img src="http://d2qcctj8epnr7y.cloudfront.net/images/jayson/photostream/Pinterest-icon.png">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ftr-social-wrap">
                                            <div class="wrapEffect sf2 ss2 s2">
                                                <img src="http://d2qcctj8epnr7y.cloudfront.net/images/jayson/photostream/Twitter-icon.png">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h2 style="font-size: 30px; font-weight: 400; text-shadow: 2px 2px 1px rgb(0, 0, 0);">Import your streams through your social accounts.</h2>
                            <a class="header-btn" href="<?php echo base_url()?>signup">Join now</a>
                        </div><!-- /header-description -->
                        <div class="header-features">
                            <div class="row-fluid">
                                <div class="span6 header-feature">
                                    <h3><i class="icon-random"></i> &nbsp; Extremely flexible</h3>
                                    <p>Create your own Stream with your friends, team or family. Make it private or public. Up to 250mb per stream for free and up to 2 streams per user.Your choice!</p>
                                </div>
                                <div class="span6 header-feature">
                                    <h3> <i class="icon-group"></i> &nbsp; Importing Star</h3>
                                    <p>Import from Facebook, Google+, Flickr, Twitter, Instagram, Pinterest or from Iphone or Android Phone.</p>
                                </div>
                            </div>
                        </div><!-- /header-features -->
                    </div><!-- /span12 -->
                </div><!-- /row-fluid -->
            </div><!-- /container -->
        </header>
        <section id="features" class="features">
            <div class="container">
                <div class="row-fluid">
                    <div class="span3">
                        <div class="feature">
                            <i class="icon-globe icon-2x pull-left"></i>
                            <h4>Used by Millions</h4>
                            <p>Let your streams be known worldwide.</p>
                        </div>
                    </div><!-- /span3 -->
                    <div class="span3">
                        <div class="feature">
                            <i class="icon-wrench icon-2x pull-left"></i>
                            <h4>Developer Friendly</h4>
                            <p>Public feeds and apis are ready for pulling and forking at GitHub.</p>
                        </div>
                    </div><!-- /span3 -->
                    <div class="span3">
                        <div class="feature">
                            <i class="icon-desktop icon-2x pull-left"></i>
                            <h4>Responsive</h4>
                            <p>From desktop to mobile. Create galleries with ease.</p>
                        </div>
                    </div><!-- /span3 -->
                    <div class="span3">
                        <div class="feature">
                            <i class="icon-thumbs-up icon-2x pull-left"></i>
                            <h4>Compact</h4>
                            <p>Import and export from anywhere</p>
                        </div>
                    </div><!-- /span3 -->
                </div><!-- /row-fluid -->
            </div><!-- /container -->
        </section>
        <footer id="footer" class="footer">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <h1 class="footer-title pull-left"><a href="<?php echo base_url()?>">PhotoStream.com</a></h1>
                        <p class="pull-right copyright">
                            &copy All Right Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/js/jquery.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="/js/gmaps.js"></script>
        <script src="/js/script.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                //Tooltips
                $(".tip_trigger").hover(function(){
                    tip = $(this).find('.tip');
                    tip.show(); //Show tooltip
                },
                function() {
                    tip.hide(); //Hide tooltip
                }).mousemove(
                function(e) {
                    var mousex = e.pageX + 20; //Get X coodrinates
                    var mousey = e.pageY + 20; //Get Y coordinates
                    var tipWidth = tip.width(); //Find width of tooltip
                    var tipHeight = tip.height(); //Find height of tooltip
                    //Distance of element from the right edge of viewport
                    var tipVisX = $(window).width() - (mousex + tipWidth);
                    //Distance of element from the bottom of viewport
                    var tipVisY = $(window).height() - (mousey + tipHeight);
                    if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
                        mousex = e.pageX - tipWidth - 20;
                    } if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
                        mousey = e.pageY - tipHeight - 20;
                    }
                    tip.css({  top: mousey, left: mousex });
                });
            });
        </script>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#feature-ul-social').fadeIn('fast',function(){
                    jQuery('.sf1').removeClass('s1');
                    jQuery('.sf2').removeClass('s2');
                    jQuery('.sf3').removeClass('s3');
                    jQuery('.sf4').removeClass('s4');
                    jQuery('.sf5').removeClass('s5');
                    jQuery('.sf6').removeClass('s6');
                    setTimeout(function(){
                        jQuery('.sf1').removeClass('ss1');
                        jQuery('.sf2').removeClass('ss2');
                        jQuery('.sf3').removeClass('ss3');
                        jQuery('.sf4').removeClass('ss4');
                        jQuery('.sf5').removeClass('ss5');
                        jQuery('.sf6').removeClass('ss6');
                    },2000);
                    setTimeout(function(){
                        jQuery('.sf1').removeClass('wrapEffect ss1');
                        jQuery('.sf2').removeClass('wrapEffect ss2');
                        jQuery('.sf3').removeClass('wrapEffect ss3');
                        jQuery('.sf4').removeClass('wrapEffect ss4');
                        jQuery('.sf5').removeClass('wrapEffect ss5');
                        jQuery('.sf6').removeClass('wrapEffect ss6');
                    },2500);
                });

            });
        </script>
    </body>
</html>

