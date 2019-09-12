<?php require('include/header.php'); ?>
<section class="test-speaking">
    <div class="container background-test">
        <div class="row">
            <div class="col group-test text-center">
                <div class="group-test__title">
                    IELTS Recent Actual Test With Answers (Vol 6)
                </div>
                <div class="group-test__subtitle">
                    LISTENING PRACTICE TEST 1
                </div>
                <div class="group-test__custom-border-bottom"></div>
            </div>
        </div>
        <div class="user_guide">
            <div class="user_guide_title"><span>Ẩn</span> hướng dẫn làm bài</div>
            <div class="user_guide_content">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-xl-7 col-md-10 question">
                <?php for ($i=0; $i < 6; $i++) { ?>
                    <div class="row item">
                        <div class="col-12 col-sm-3"><strong>Question 1:</strong></div>
                        <div class="col-12 col-sm-9">
                            <div class="show_tape">
                                Show tape script
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </div>
                            <div class="player audio-player-time-countdown">
                                <div class="audio-player">
                                    <!-- nút play pause file audio -->
                                    <div class="group-button-audio">
                                        <a href="" class="group-button-audio__button-play">
                                            <i class="fa fa-play-circle btn-play-pause" aria-hidden="true"></i>
                                        </a>
                                        <div class="group-button-audio__button-pause">
                                            <!-- <i class="fa fa-pause-circle  btn-play-pause" aria-hidden="true"></i> -->
                                        </div>
                                    </div>

                                    <!-- thời gian file audio -->
                                    <div class="time-play d-flex align-item-center">
                                        <div class="time-play__time-audio">
                                            00:00
                                        </div>
                                        <div class="time-play__audio-time-line">
                                            <div class="position-play-dot">

                                            </div>
                                        </div>
                                        <!--<div class="time-play__time-left">
                                            03:43
                                        </div>-->
                                    </div>

                                    <!-- chỉnh volume -->
                                    <div class="volume d-flex align-item-center">
                                        <a href="" class="volume__icon">
                                            <i class="fa fa-volume-up" aria-hidden="true"></i>
                                            <!-- <i class="fa fa-volume-down" aria-hidden="true"></i> -->
                                            <!-- <i class="fa fa-volume-off" aria-hidden="true"></i> -->
                                        </a>
                                        <div class="volume__level"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3"><strong>Bài làm của bạn:</strong></div>
                        <div class="col-12 col-sm-9 form-inline">
                            <button class="btn btn-outline-danger form-control">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>Start Record
                            </button>
                            <button class="btn btn-danger form-control">
                                <i class="fa fa-pause" aria-hidden="true"></i>Pause Record 
                            </button>
                            <button class="btn btn-outline-info form-control">
                                <i class="fa fa-check" aria-hidden="true"></i>Finish Record 
                            </button>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
            


        </div>
    </div>
</section>
<section class="information">
    <div class="container">
        <div class="row">
            <div class="col designed-build text-center">
                Designed and built with all the love in the world by the Imap team
            </div>
        </div>
    </div>
</section>
<footer id="footer-test" class="fixed-bottom">
    <div class="container">
        <div class="row align-item-center footer-test-speaking">
            <div class="col-6 audio-player-time-countdown">
                <!-- thời gian làm bài còn lại -->
                <div class="time-countdown-test-speaking time-countdown-test-speaking_left">
                    <span class="time-countdown-test-speaking__icon">
                        <span class="icon-round-timer-24px"></span>
                    </span>
                    <span class="time-countdown-test-speaking__time">
                        39:23
                    </span>
                </div>
                <!-- kết thúc thời gian làm bài còn lại -->
            </div>
            <div class="col-6 text-right">
                <button class="btn btn-danger form-control next_section">
                    next section <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</footer>
<?php require('include/footer.php'); ?>
<script type="text/javascript">
    $(".user_guide_title").bind("click",function(){
        if ($(".user_guide_content").is(':visible')) {
            $(".user_guide_content").hide();
            $(this).find("span").text("Hiện");
        }
        else {
            $(".user_guide_content").show();
            $(this).find("span").text("Ẩn");
        }
        
    })
</script>