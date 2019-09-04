<h1 class="my_title">Dashboard
    <i class="fa fa-info-circle fa_info_feedback" aria-hidden="true" data-toggle="modal" data-target="#modal_info"></i>
</h1>

<div class="modal" id="modal_info">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Genaral Infomation</h4>
                <!--                        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><i></i>Số lượng Feedback: <span><?php echo $count_paper; ?></span></p>
                <p><i></i>Số lượng Lớp học: <span><?php echo $count_class; ?></span></p>
                <p><i></i>Số lượng Giáo viên: <span><?php echo $count_teacher; ?></span></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="modal_giao_tiep_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Giao tiếp Infomation</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><i></i>Số lượng Feedback: <span><?php echo $info_giaotiep['count_paper']; ?></span></p>
                <p><i></i>Số lượng Lớp học: <span><?php echo $info_giaotiep['count_class'] ; ?></span></p>
                <p><i></i>Số lượng Giáo viên: <span><?php echo $info_giaotiep['count_teacher']; ?></span></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="modal_toeic_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Toeic Infomation</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><i></i>Số lượng Feedback: <span><?php echo $info_toeic['count_paper']; ?></span></p>
                <p><i></i>Số lượng Lớp học: <span><?php echo $info_toeic['count_class'] ; ?></span></p>
                <p><i></i>Số lượng Giáo viên: <span><?php echo $info_toeic['count_teacher']; ?></span></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="modal_ielts_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ielts Infomation</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><i></i>Số lượng Feedback: <span><?php echo $info_ielts['count_paper']; ?></span></p>
                <p><i></i>Số lượng Lớp học: <span><?php echo $info_ielts['count_class'] ; ?></span></p>
                <p><i></i>Số lượng Giáo viên: <span><?php echo $info_ielts['count_teacher']; ?></span></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="modal_aland_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Aland Infomation</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><i></i>Số lượng Feedback: <span><?php echo $info_aland['count_paper']; ?></span></p>
                <p><i></i>Số lượng Lớp học: <span><?php echo $info_aland['count_class'] ; ?></span></p>
                <p><i></i>Số lượng Giáo viên: <span><?php echo $info_aland['count_teacher']; ?></span></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>







<div class="container-fluid">
    <div style="margin-right: 15%; margin-left: 15%">
        <div class="row">
            <div class="col col-sm-12 col-md-3 ">
                <div class="card_feedback">
                    <h3 class="title_card">Report Giao tiếp
                        <i class="fa fa-info-circle fa_info_feedback card_info_btn" aria-hidden="true" data-toggle="modal" data-target="#modal_giao_tiep_info"></i>
                    </h3>
                    <div class="img_logo_feed">
                        <a href="/feedback/giaotiep" target="_blank">
                            <img class="img_logo_feed_inside" src="theme/frontend/default/images/images/logo/giaotiep.png" alt="Xem mẫu">
                        </a>
                    </div>
                    <div class="giaotiep_report body_card">
                        <div>
                            <p class="text_card">Danh sách 10 lớp nhận feedback gần nhất</p>

                            <?php
                            if (isset($top_class_giaotiep)) {
                                for ($i = 0; $i < count($top_class_giaotiep); $i++) {
                                    $mono = json_decode($top_class_giaotiep[$i], true);
                                    $type = $mono[0];
                                    $class_code = $mono[1];
                                    ?>
                                    <p><?php echo $i + 1; ?>. <a href="/feedback/statistic/<?php echo $class_code; ?>"
                                                                 target="_blank"><?php echo $class_code; ?></a></p>

                                    <?php

                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-sm-12 col-md-3 ">
                <div class="card_feedback">
                    <h3 class="title_card">Report Toiec
                        <i class="fa fa-info-circle fa_info_feedback card_info_btn" aria-hidden="true" data-toggle="modal" data-target="#modal_toeic_info"></i>
                    </h3>

                    <div class="img_logo_feed">
                        <a href="/feedback/toeic" target="_blank">
                            <img class="img_logo_feed_inside" src="theme/frontend/default/images/images/logo/toeic.jpg" alt="Xem mẫu">
                        </a>

                    </div>
                    <div class="toeic_report body_card">
                        <div>
                            <p class="text_card">Danh sách 10 lớp nhận feedback gần nhất</p>

                            <?php
                            if (isset($top_class_toeic)) {
                                for ($i = 0; $i < count($top_class_toeic); $i++) {
                                    $mono = json_decode($top_class_toeic[$i], true);
                                    $type = $mono[0];
                                    $class_code = $mono[1];
                                    ?>
                                    <p><?php echo $i + 1; ?>. <a href="/feedback/statistic/<?php echo $class_code; ?>"
                                                                 target="_blank"><?php echo $class_code; ?></a></p>

                                    <?php

                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-sm-12 col-md-3">
                <div class="card_feedback">

                <h3 class="title_card">Report Ielts
                    <i class="fa fa-info-circle fa_info_feedback card_info_btn" aria-hidden="true" data-toggle="modal" data-target="#modal_ielts_info"></i>
                </h3>

                <div class="img_logo_feed">
                    <a href="/feedback/ielts"  target="_blank">
                        <img class="img_logo_feed_inside" src="theme/frontend/default/images/images/logo/ielts.png" alt="Xem mẫu">
                    </a>
                </div>
                <div class="ielts_report body_card">
                    <div>
                        <p class="text_card">Danh sách 10 lớp nhận feedback gần nhất</p>
                        <?php
                        if (isset($top_class_ielts)) {
                            for ($i = 0; $i < count($top_class_ielts); $i++) {
                                $mono = json_decode($top_class_ielts[$i], true);
                                $type = $mono[0];
                                $class_code = $mono[1];
                                ?>
                                <p><?php echo $i + 1; ?>. <a href="/feedback/statistic/<?php echo $class_code; ?>"
                                                             target="_blank"><?php echo $class_code; ?></a></p>

                                <?php

                            }
                        }

                        ?>
                    </div>
                </div>

                </div>
            </div>

            <div class="col col-sm-12 col-md-3">
                <div class="card_feedback">

                    <h3 class="title_card">Report Aland
                        <i class="fa fa-info-circle fa_info_feedback card_info_btn" aria-hidden="true" data-toggle="modal" data-target="#modal_aland_info"></i>
                    </h3>

                    <div class="img_logo_feed">
                        <a href="/feedback/aland"  target="_blank">
                            <img class="img_logo_feed_inside" src="theme/frontend/default/images/images/logo/aland.png" alt="Xem mẫu">
                        </a>
                    </div>
                    <div class="aland_report body_card">
                        <div>
                            <p class="text_card">Danh sách 10 lớp nhận feedback gần nhất</p>
                            <?php
                            if (isset($top_class_aland)) {
                                for ($i = 0; $i < count($top_class_aland); $i++) {
                                    $mono = json_decode($top_class_aland[$i], true);
                                    $type = $mono[0];
                                    $class_code = $mono[1];
                                    ?>
                                    <p><?php echo $i + 1; ?>. <a href="/feedback/statistic/<?php echo $class_code; ?>"
                                                                 target="_blank"><?php echo $class_code; ?></a></p>

                                    <?php

                                }
                            }

                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>



<div class="container-fluid" style="margin-top: 50px; border-top: 1px solid #bdbdbd;">

    <h3 class="my_title">Feedback gần đây</h3>

    <div>

        <table id="dtFeedbackList" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="th-sm">ID
                </th>
                <th class="th-sm">Thời gian
                </th>
                <th class="th-sm">Mã lớp
                </th>
                <th class="th-sm">Type
                </th>
                <th class="th-sm">Ghi chú
                </th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (isset($list_feedback_newest) && (is_array($list_feedback_newest))) {
                foreach ($list_feedback_newest as $mono_feedback_paper) {
                    $class_code_mono = $mono_feedback_paper['class_code'];
                    $type = $mono_feedback_paper['type'];
                    $time_end = $mono_feedback_paper['time_end'];
                    $name_feeder = $mono_feedback_paper['name_feeder']; ?>
                    <tr>
                        <td><?php echo $mono_feedback_paper['id'] ?></td>
                        <td><?php echo date('d/m/Y - H:i:s', $time_end); ?></td>
                        <td><?php echo $class_code_mono ?></td>
                        <td><?php echo $type ?></td>
                        <td><?php echo $name_feeder ?></td>
                    </tr>

                    <?php
                }
            }?>

            </tbody>
        </table>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('#dtFeedbackList').DataTable({
            "ordering": false // false to disable sorting (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>






