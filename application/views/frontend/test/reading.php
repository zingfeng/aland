<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash(),
);
?>
<header class="header">
    <nav class="row navigation-top">
        <div class="container"> 
            <div class="row">
                <div class="col pl-0 pr-0">
                    <nav class="navbar navbar-expand-lg ">
                        <?php echo $this->load->view('test/common/home');?> 
                        
                        <div class="collapse navbar-collapse navigation-top__menu" id="navbarText">
                            <ul class="navbar-nav mr-auto menu">
                                <li class="nav-item">
                                    <a class="nav-link menu-link button-go-back__link" href="#">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <?php
                                $i = 1; $time = 0;
                                //$test_time = 0;
                                foreach ($arrQuestion as $key => $question) { ?>
                                    <?php $nextSetion = $arrQuestion[$key+1]?>
                                    <li class="nav-item">
                                        <a data-section="<?php echo $question['question_id']; ?>" data-index="<?php echo $i-1; ?>" id="question_setion_selection_<?php echo $question['question_id']; ?>" class="reading_change_section nav-link menu-link -custom-color-link <?php echo $i == 1 ? '-active' : '' ?>" href="javascript:;">
                                            <?php echo $question['title']; ?>
                                        </a>
                                    </li>
                                <?php $i++;
                                    $test_time += $question['test_time'] * 60 * 1000;
                                } ?>
                            </ul>
                            <?php echo $this->load->view('test/common/account');?>
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
    </div>
</header>

<?php echo $this->load->view('test/common/breadcrumb');?>

<section class="test-reading test-listening">
    <div class="container background-test">
        <div class="row">
            <div class="col group-test text-center">
                <div class="group-test__title">
                    <?php echo $test['title']?>
                </div>
                <div class="group-test__subtitle">
                    READING PRACTICE
                </div>
                <div class="group-test__custom-border-bottom"></div>
            </div>
        </div>
        <form class="form" method="POST" action="/test/result" id="test_form">
            <input type="hidden" name="test_id" value="<?php echo $test['test_id']; ?>">
            <input type="hidden" name="type" value="<?php echo $keyType; ?>">
            <input type="hidden" name="start_time" value="<?php echo $start_time; ?>">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

            <?php
            if (isset($arr_fulltest_all_detail)){
                echo '<input type="hidden" name="fulltest_timestamp" value="' . $arr_fulltest_all_detail['fulltest_timestamp'].  '">';
                echo '<input type="hidden" name="fulltest_all_step" value=\''. $arr_fulltest_all_detail['fulltest_all_step'] .'\'>';
                echo '<input type="hidden" name="fulltest_now_step" value="'.$arr_fulltest_all_detail['fulltest_now_step'].'">';
            }
            ?>
            <?php
            $number_question = 1;
            foreach ($arrQuestion as $qkey => $question) {
                ?>
                <div class="row no-gutters question_section_content" id="question_section_<?php echo $question['question_id']; ?>" <?php echo ($number_question != 1) ? 'style="display: none"' : '' ?>>
                    <div id="col1" class="col col_gutter read">
                        <h2 class="title"><?php echo $question['title']; ?></h2>
                        <div class="read_content">
                            <?php echo $question['detail']; ?>
                        </div>
                    </div>
                    <div id="col2" class="col col_gutter answer">
                        <?php foreach ($arrQuestionGroup[$question['question_id']] as $key => $qgroup) { ?>
                            <div class="question bg_warp mb30">
                                <h3><?php echo $qgroup['title']; ?></h3>
                                <p><?php echo $qgroup['detail']; ?></p>
                                <?php echo $this->load->view("test/question/type_" . $qgroup['type'], array('rows' => $qgroup['question_answer'], 'number' => $number_question)); ?>
                            </div>
                            <?php $number_question += $qgroup['number_question'];?>
                        <?php } ?>
                    </div>
                </div>
                <?php $arrNumberCheck[$question['question_id']] = $number_question;?>
            <?php } ?>
        </form>
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
        <!-- view tablet desktop -->
        <div class="row align-item-center footer-reading-view-desktop-tablet">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4">
                <button class="btn btn-outline-primary form-control" onclick="showQuestionsList()">
                    Bảng câu hỏi
                </button>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-4 text-center">
                <!-- thời gian làm bài còn lại -->
                <div class="time-countdown-test-reading-view-desktop-mobile align-item-center">
                    <span class="time-countdown-test-reading-view-desktop-mobile__icon">
                        <span class="icon-round-timer-24px"></span>
                    </span>
                    <span class="time-countdown-test-reading-view-desktop-mobile__time show_count_down"></span>
                </div>
                <!-- kết thúc thời gian làm bài còn lại -->
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 passage-control">
                <?php foreach ($arrQuestion as $i => $question) {?>
                    <?php if ($nextSection = $arrQuestion[$i + 1]) {?>
                        <button class="btn btn-danger form-control reading_change_section" data-section="<?php echo $nextSection['question_id']; ?>" data-index="<?php echo $i+1?>" data-ci=<?php echo $i?> <?php echo $i != 0 ? 'style="display:none"' : ''?>><?php echo $nextSection['title']; ?>&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                    <?php } else { ?>
                        <button data-ci="<?php echo $i?>" class="btn btn-danger form-control submit_answer_result" type="submit"  style="display: none">Nộp bài</button> 
                    <?php } ?>
                <?php }?>
            </div>
        </div>
        <!-- End view tablet desktop -->

        <!-- view mobile -->
        <div class="row align-item-center footer-reading-view-mobile">
            <div class="col-2">
                <button class="btn btn-outline-primary btn-sm" onclick="showQuestionsList()">
                <i class="fa fa-check" aria-hidden="true"></i>
                </button>           
            </div>
            <div class="col-6 align-item-center text-center">
            <div class="time-countdown-test-reading-view-mobile align-item-center">
                    <span class="time-countdown-test-reading-view-mobile__icon">
                        <span class="icon-round-timer-24px"></span>
                    </span>
                    <span class="time-countdown-test-reading-view-mobile__time show_count_down"></span>                   
                </div>               
            </div>
            <div class="col-4 passage-control">
                <?php foreach ($arrQuestion as $i => $question) {?>
                    <?php if ($nextSection = $arrQuestion[$i + 1]) {?>
                        <button class="btn btn-danger btn-sm w-100 reading_change_section" data-section="<?php echo $nextSection['question_id']; ?>" data-index="<?php echo $i+1?>" data-ci=<?php echo $i?> <?php echo $i != 0 ? 'style="display:none"' : ''?>><?php echo $nextSection['title']; ?>&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                    <?php } else { ?>
                        <button data-ci="<?php echo $i?>" class="btn btn-danger btn-sm w-100 submit_answer_result" type="submit"style="display: none">Nộp bài</button> 
                    <?php } ?>
                <?php }?>
            </div>
        </div>
        <!-- End view mobile -->
    </div>
</footer>

<!-- ------------------bảng câu hỏi----------------- -->
<section id="questions-list">
    <div class="container background-questions-list">
        <div class="row justify-content-between title-button-hide-questions-list">
            <div class="col-6  title-button-hide-questions-list__title">
                Bảng câu hỏi
            </div>
            <div class="col-6 text-right">
                <a class="button-hide-questions-list" onclick="hideQuestionsList()">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12  questions-list" id="list_answer">
                <?php
                $j = 1;
                foreach ($arrNumberCheck as $question_id => $number_max) {
                    for ($i = $j; $i < $number_max; $i++) {?>
                        <a href="javascript:;" data-section="<?php echo $question_id; ?>" class="answer_recheck answer_recheck_item_<?php echo $i; ?> questions-number -not-done-yet" data-q="q-<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php }
                    $j = $i;
                }?>
            </div>
        </div>
    </div>
</section>
<!-- kết thúc bảng câu hỏi -->

<script src="<?php echo $this->config->item("js"); ?>split.min.js"></script>
<script type="text/javascript">
    $(function(){
        cal_main_height();
        jQuery('.scrollbar-inner').scrollbar();
        $(".reading_change_section").bind("click",function(){
            var section_id = $(this).attr("data-section");
            $(".question_section_content").hide();
            $("#question_section_" + section_id).show();

            $(".reading_change_section").removeClass("-active");
            $("#question_setion_selection_" + section_id).addClass("-active");

            $("table").colResizable({disable : true });
            $("#question_section_" + section_id).colResizable({liveDrag:true});

            //Show-hide next page
            var dataIndex = $(this).attr("data-index");
            $(".passage-control button").hide();
            $('.passage-control button[data-ci="' + dataIndex +'"]').show();
        });
        $("#test_form").find("select").bind("change",function(){
            var number = $(this).attr("data-question-number");

        });
        $(".answer_recheck").bind("click",function(){

        });
        window.onbeforeunload = function() {
            //return "Data will be lost if you leave the page, are you sure?";
        };
        // scroll box ket qua
        //$('.scrollbar-inner').scrollbar();
        // count downtime
        function liftOff() {
            $("#test_form").submit();
        }

        var fiveSeconds = new Date().getTime() + parseInt(<?php echo (int) $test_time; ?>);
        $('.show_count_down').countdown(fiveSeconds, {elapse: true})
            .on('update.countdown', function(event) {
                var this_countdown = $('.show_count_down');
                if (event.elapsed) {
                    // $this.html('Hết thời gian làm bài');
                    return liftOff();
                } else {
                    this_countdown.html(event.strftime('%M : %S'));
                }
            });

        /* $("#test_form").on("submit",function(e) {

              e.preventDefault(); // avoid to execute the actual submit of the form.

              var form = $(this);
              var url = form.attr('action');
              console.log(form.serialize());
              $.ajax({
                  type: "POST",
                  url: url,
                     data: form.serialize(), // serializes the form's elements.
                     success: function(data)
                     {
                         console.log(data);
                     }
                    });
              return false;

            }); */

        /// submit
        $(".submit_answer_result").bind("click",function(e){
            e.preventDefault(); // avoid to execute the actual submit of the form.
            e.stopPropagation();


            var r = confirm("Bạn có chắc muốn nộp bài ?");
            if (r === true) {
                $("#test_form").submit();
            }
            return false;

        });

        $(function(){
            jQuery('.scrollbar-inner').scrollbar();
            <?php foreach ($arrQuestion as $qkey => $question) { ?>
            $("#question_section_<?php echo $question['question_id']; ?>").colResizable({
                liveDrag:true,
                gripInnerHtml:"<div class='grip'></div>",
                draggingClass:"dragging",
                resizeMode:'fit',
                // disable: true
            });
            <?php } ?>
        });

        $('#list_answer').on('click', '.answer_recheck', function (event) {
            event.preventDefault();
            var id = $(this).attr('data-section');
            var qid = $(this).attr('data-q');

            var tagName = $("#"+ qid)[0].tagName;
            if($('#question_section_' + id + ':visible').length == 0){
                $("div.question_section_content").hide().colResizable({disable : true });
                $("#question_section_" + id).show().colResizable({liveDrag:true});

                //Reactive section
                $(".reading_change_section").removeClass("-active");
                $("#question_setion_selection_" + id).addClass("-active");
            }

            //Focus
            if (tagName === 'INPUT' || tagName === 'SELECT') {
                $("#"+ qid).focus();
            }
        })
    });


    /* JS Goes Here */
    if ($(document).width() > 768) {
        Split(['#col1', '#col2'], {
            elementStyle: (dimension, size, gutterSize) => ({
                'flex-basis': `calc(${size}% - ${gutterSize}px)`,
            }),
            gutterStyle: (dimension, gutterSize) => ({
                'flex-basis':  `5px`,
            }),
            minSize: 500
        });
    }
</script>

<style type="text/css">
    /* Only in showing */
    .tilte_explain_question{
        display: none !important;
    }
    .content_explain_question{
        background-color: transparent !important;
        padding: 0 !important;
    }
</style>