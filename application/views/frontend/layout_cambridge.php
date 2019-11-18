<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-title" content="Phuoc PM"/>
    <meta name="description" content="Phuoc PM">
    <meta name="author" content="PhuocPM">
    <meta name="keywords" content="">
    <base href="./" target="_blank">
    <title>Homepage - Aland Cambridge</title>
    <link rel="stylesheet" href="<?php echo $this->config->item("css"); ?>fonts/fontawesome-5.11.2/css/all.min.css" media="all"/>
    <link rel="stylesheet" href="<?php echo $this->config->item("css"); ?>bootstrap-4.3.1/bootstrap.min.css" media="all"/>
    <link rel="stylesheet" href="<?php echo $this->config->item("css"); ?>uikit-3.2.2/uikit.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("css"); ?>animate.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("css"); ?>cam_style.css" media="all">
    <link rel="stylesheet" href="<?php echo $this->config->item("css"); ?>owlcarousel-2.3.4/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("css"); ?>owlcarousel-2.3.4/owl.theme.default.min.css">
</head>
<body class="cam_aland-cambridge">
<div class="home-page aland-cambridge">
    <header class="header fixed-top active-pc">
        <div class="container-fluid-30">
            <div class="panel-head">
                <h1 class="logo">
                    <a href="" title="" class="image img-scaledown">
                        <img src="<?php echo $this->config->item('img')?>logo-header.jpg" alt="">
                    </a>
                </h1>

                <ul class="main-menu-1">
                    <li>
                        <a href="" title="" class="title-menu">Trang chủ</a>
                    </li>
                    <li class="sub-menu">
                        <a href="" title="" class="title-menu">Khóa học</a>
                        <div class="dropdown-menu">
                            <ul class="main-menu-2">
                                <li>
                                    <a href="" title="" class="menu-child">Khóa học Online</a>
                                </li>
                                <li>
                                    <a href="" title="" class="menu-child">Khóa học Offline</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="" title="" class="title-menu">Test Online</a>
                    </li>
                    <li>
                        <a href="" title="" class="title-menu">Tin tức</a>
                    </li>
                    <li>
                        <a href="" title="" class="title-menu">Liên hệ</a>
                    </li>
                    <li>
                        <a href="" title="" class="title-menu"><i class="fas fa-search"></i></a>
                    </li>
                </ul>

                <div class="login">
                    <button type="button" class="btn btn-outline-danger">Đăng nhập</button>
                </div>
            </div>
        </div>
    </header>

    <header class="header-mb active-mb">
        <div id="menu-container">
            <div class="panel-head-mb">
                <div id="menu-wrapper">
                    <div id="hamburger-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <h1 class="logo-mb">
                    <a href="" title="" class="image img-scaledown">
                        <img src="<?php echo $this->config->item('img')?>logo-mb-2.jpg" alt="">
                    </a>
                </h1>
                <button type="button" class="btn btn-default">Đăng nhập</button>
            </div>
            <div class="panel-body-mb">
                <ul class="menu-list accordion">
                    <li class="search-mb">
                        <svg id="_24px_33_" data-name="24px (33)" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" viewBox="0 0 24 24">
                            <path id="Path_416" data-name="Path 416"
                                  d="M15.5,14h-.79l-.28-.27a6.51,6.51,0,1,0-.7.7l.27.28v.79l5,4.99L20.49,19Zm-6,0A4.5,4.5,0,1,1,14,9.5,4.494,4.494,0,0,1,9.5,14Z"
                                  fill="#575757"/>
                            <path id="Path_417" data-name="Path 417" d="M0,0H24V24H0Z" fill="none"/>
                        </svg>
                        <input type="text" placeholder="Tìm kiếm" class="input-search active-mb">
                    </li>

                    <li id="nav1" class="toggle">
                        <a class="menu-link" href="#">Trang chủ</a>
                    </li>

                    <li id="nav2" class="toggle accordion-toggle">
                        <a class="menu-link" href="#">Khóa học</a>
                    </li>
                    <ul class="menu-submenu accordion-content">
                        <li><a class="head" href="#">Khóa học Online</a></li>
                        <li><a class="head" href="#">Khóa học Offline</a></li>
                    </ul>

                    <li id="nav3" class="toggle">
                        <a class="menu-link" href="#">Test Online</a>
                    </li>

                    <li id="nav3" class="toggle">
                        <a class="menu-link" href="#">Tin tức</a>
                    </li>

                    <li id="nav3" class="toggle">
                        <a class="menu-link" href="#">Liên hệ</a>
                    </li>

                </ul>
            </div>
        </div>
    </header>

    <?= $contents ?>

    <footer class="footer">
        <div class="container">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 ft-contact">
                        <h3 class="logo">
                            <a href="" title="" class="image">
                                <img src="<?php echo $this->config->item('img')?>logo-footer.png" alt="">
                            </a>
                        </h3>
                        <p class="contact">Hotline: 0123 456 789</p>
                        <p class="contact">Email: chienbinh@ielts-fighter.com</p>
                        <ul class="list-social">
                            <li><a href="" title="" class="social"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="" title="" class="social"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 ft-menu active-pc">
                        <h3 class="heading">About Us</h3>
                        <ul class="list-ft-menu">
                            <li><a href="" title="" class="title-menu">About Us</a></li>
                            <li><a href="" title="" class="title-menu">About Us</a></li>
                            <li><a href="" title="" class="title-menu">About Us</a></li>
                            <li><a href="" title="" class="title-menu">About Us</a></li>
                            <li><a href="" title="" class="title-menu">About Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 ft-menu active-pc">
                        <h3 class="heading">IELTS Online</h3>
                        <ul class="list-ft-menu">
                            <li><a href="" title="" class="title-menu">IELTS Online</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Online</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Online</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Online</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Online</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 ft-menu active-pc">
                        <h3 class="heading">IELTS Test</h3>
                        <ul class="list-ft-menu">
                            <li><a href="" title="" class="title-menu">IELTS Test</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Test</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Test</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Test</a></li>
                            <li><a href="" title="" class="title-menu">IELTS Test</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 ft-fanpge active-pc">
                        <h3 class="heading">Fanpage</h3>
                        <!-- 							<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fimappro.edu.vn%2F&tabs=timeline&width=340&height=225&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=2068646313200274" width="340" height="225" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <p>Trực thuộc công ty cổ phần giáo dục và đào tạo Imap Việt Nam</p>
        </div>
    </footer>

    <section class="video-popup">
        <div class="modal fade video-modal-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/GIDoQsQyS0s" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="modal fade video-modal-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/GIDoQsQyS0s" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="modal fade video-modal-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/GIDoQsQyS0s" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="modal fade video-modal-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/GIDoQsQyS0s" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
<a href="javascript:;" id="to_top"><i class="fas fa-arrow-up"></i></a>
</body>
<script type="text/javascript" src="<?php echo $this->config->item('js')?>jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="fonts/fontawesome-5.11.2/js/all.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js')?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js')?>uikit.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js')?>uikit-icons.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js')?>owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->item('js')?>app.js"></script>
</html>
