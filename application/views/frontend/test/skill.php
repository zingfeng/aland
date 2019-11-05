<section class="container clearfix m_height testgroup-page">
    <nav aria-label="breadcrumb" class="nav-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL?>">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="text-transform: capitalize;"><?php echo $type?></li>
        </ol>
    </nav>
    <div class="row content-page">
        <div id="sidebar_left" class="tg-sec col-md-8 col-sm-8 col-xs-8 col-tn-12">
            <div class="tg-sec-top mgb25">
                <a href="" title="" class="image img-cover">
                <img src="<?php echo $this->config->item('img')?>sec-top.jpg" alt="">
                </a>
            </div>
            <div class="content-left mgb25">
                <div class="panel-head">
                    <h3 class="heading">Mô tả</h3>
                    <p class="desc">
                        Tự hào là nơi tiên phong áp dụng công nghệ 4.0 vào bài thi Test IELTS Online, Aland IELTS mang đến cho người học IELTS một hệ thống kiểm tra toàn diện 4 kỹ năng (Listening – Reading – Speaking – Writing) chuyên biệt hàng đầu Việt Nam.
                    </p>
                    <!-- <a href="" title="" class="readmore">Xem thêm</a> -->
                </div>
                <?php if($rows) { ?>
                <div class="panel-body">
                    <div class="tg-sec-testlist mgb15">
                        <div class="panel-head">
                            <h3 class="heading">
                            Danh sách bài test</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php foreach($rows as $row) { ?>
                                <div class="col-lg-4 mgb15">
                                    <div class="item">
                                        <div class="content">
                                            <div class="thumb">
                                                <a href="<?php echo str_replace('/test/', '/test/'.$type.'/', $row['share_url']); ?>?skill=1" title="<?php echo $row['title']?>" class="image img-cover">
                                                    <img src="<?php echo getimglink($share_url['images'])?>" alt="<?php echo $row['title']?>">
                                                </a>
                                                <a href="<?php echo str_replace('/test/', '/test/'.$type.'/', $row['share_url']); ?>?skill=1" title="<?php echo $row['title']?>" class="overlay">
                                                    <div class="overlay-content">
                                                        <p>IELTS</p>
                                                        <p><?php echo $row['title']?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tg-sec-form mgb25">
                        <div class="panel-head mgb25">
                            <h3 class="title">
                                Bạn có muốn trải nghiệm môi trường 
                                <span class="color-red"> thi thử như thật tại Aland</span>
                            </h3>
                            <h3 class="title">
                                Đăng ký ngay hôm nay - tặng thẻ thư viện 
                                <span class="color-red"> 1.000.000đ</span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <form action="" class="form-content">
                                <div class="row">
                                    <div class="col-lg-4 col-left">
                                        <p class="title">Họ và tên</p>
                                    </div>
                                    <div class="col-lg-8 col-right">
                                        <input type="text" class="" placeholder="Nhập họ và tên">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-left">
                                        <p class="title">Số điện thoại</p>
                                    </div>
                                    <div class="col-lg-8 col-right">
                                        <input type="text" class="" placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-left">
                                        <p class="title">Email</p>
                                    </div>
                                    <div class="col-lg-8 col-right">
                                        <input type="text" class="" placeholder="Nhập email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-left">
                                        <p class="title">Chọn cơ sở</p>
                                    </div>
                                    <div class="col-lg-8 col-right">
                                        <select name="" id="">
                                            <option value="">Chọn cơ sở</option>
                                            <option value="">Cơ sở 1</option>
                                            <option value="">Cơ sở 2</option>
                                            <option value="">Cơ sở 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-left"></div>
                                    <div class="col-lg-8 col-right">
                                        <a href="" title="" class="btn-submit btn-1">Đăng ký thi thử</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->
                    <?php if($arrNews) { ?>
                    <div class="tg-sec-article">
                        <div class="panel-head">
                            <div class="col-lg-8 panel-left">
                                <h3 class="heading">Bài viết liên quan</h3>
                            </div>
                            <div class="col-lg-4 panel-right">
                                <a href="" title="" class="readmore">Xem tất cả</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php foreach($arrNews as $row) { ?>
                                <div class="col-lg-4">
                                    <div class="item">
                                        <div class="thumb">
                                            <a href="<?php echo SITE_URL . $row['share_url'];?>" title="<?php echo $row['title'];?>">
                                                <img title="<?php echo $row['title'];?>" src="<?php echo getimglink($row['images'],'size1',3);?>" alt="<?php echo $row['title'];?>">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <a href="<?php echo SITE_URL . $row['share_url'];?>" title="<?php echo $row['title'];?>">
                                                <?php echo $row['title'];?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <div id="sidebar_right" class="tg-aside col-md-4 col-sm-4 col-xs-4 col-tn-12 mb20">
            <?php echo $this->load->get_block('right'); ?>
            <div class="sidebar-block"> 
                <div class="title-header-bl"><h2>FANPAGE</h2></div>
                <div class="fb-page" data-href="<?php echo $this->config->item('facebook');?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo $this->config->item('facebook');?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $this->config->item('facebook');?>">Facebook</a></blockquote></div>
            </div><!--End-->
        </div>
    </div>
</section>
<!-- END CONTENT_PAGE -->