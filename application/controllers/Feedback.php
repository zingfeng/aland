<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller
{
    // Dashboard
    public function index3(){
        phpinfo();

        exit;
        $this->guard();
        // md bootstrap
        // Quản lý danh sách lớp
        // Quản lý danh sách giảng viên
        // 1 view
        //
        $this->load->model('Feedback_model', 'feedback');

        $top_class_ielts = $this->feedback->get_top_class_feedback_newest(10,'ielts');
        $top_class_toeic = $this->feedback->get_top_class_feedback_newest(10,'toeic');
        $top_class_giaotiep = $this->feedback->get_top_class_feedback_newest(10,'giaotiep');
        $top_class_aland = $this->feedback->get_top_class_feedback_newest(10,'aland');

        $list_feedback_newest = $this->feedback->get_list_feedback_paper('','','time_end');

        $list_feedback_newest = array_slice($list_feedback_newest,0,200); // 100 feed back mới nhất

        $info = $this->feedback->get_all_info_system();

        $info_giaotiep = $this->feedback->get_all_info_system_by_type('giaotiep');
        $info_toeic = $this->feedback->get_all_info_system_by_type('toeic');
        $info_ielts = $this->feedback->get_all_info_system_by_type('ielts');
        $info_aland = $this->feedback->get_all_info_system_by_type('aland');
        $data = array(
            'list_feedback_newest' => $list_feedback_newest,
            'top_class_ielts' => $top_class_ielts,
            'top_class_toeic' => $top_class_toeic,
            'top_class_giaotiep' => $top_class_giaotiep,
            'top_class_aland' => $top_class_aland,
            'info_giaotiep' => $info_giaotiep,
            'info_toeic' => $info_toeic,
            'info_ielts' => $info_ielts,
            'info_aland' => $info_aland,
        );
        $data = array_merge($data, $info);

        $this->load->layout('feedback/dashboard',$data,false,'layout_feedback');

    }

    public function login(){
        if ($this->check_login()){
            redirect('/feedback');
        }

        session_start();
        $data = array();
        if (isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $account_list = array(
                'msgiang' => 'msgiang2019',
                'mshoa' => 'mshoa2019',
                'lanphuong' => 'lanphuong2019',
                'dat' => '111111111',
                'maimai' => 'maimai2020',
            );

            if (isset($account_list[$username]) && ($password === $account_list[$username] ) ){
                $_SESSION['token'] =  md5($username.'_feedback_sys_Aug_2019');
                $_SESSION['username'] = $username;

                redirect('/feedback');
            }else{
                $data['error'] = 'Tài khoản và mật khẩu đã nhập không đúng';
                echo $this->load->view('feedback/login',$data,true);
            }
        }else{
//            $data['error'] = 'ko có gì';
            echo $this->load->view('feedback/login',$data,true);
        }

    }

    private function guard(){
        if ($this->check_login()){

        }else{
            redirect('/feedback/login');
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        redirect('/feedback/login');
    }


    private function check_login(){
        if (isset($_SESSION['token']) && isset($_SESSION['username'])){
            $token = $_SESSION['token'];
            $username = $_SESSION['username'];
            $token_check = md5($username.'_feedback_sys_Aug_2019');
            if ($token === $token_check){
                return true;
            }
            session_destroy();
        }
        return false;
    }

    // ==========================
    public function report(){
        $this->guard();

        $data = array();
        $this->load->layout('feedback/report/report',$data,false,'layout_feedback');
    }

    public function teacher (){
        $this->guard();
        $this->load->model('Feedback_model', 'feedback');
        $teacher_info = $this->feedback->get_list_info_teacher();
        $data = array(
            'teacher_info' => $teacher_info,
        );
        $this->load->layout('feedback/teacher',$data,false,'layout_feedback');
    }

    public function class_(){
        $this->guard();

        $this->_mark_all_class('');
        $this->load->model('Feedback_model', 'feedback');
        $class_info_raw = $this->feedback->get_list_class_info();
        $class_info = array();

        foreach ($class_info_raw as $item) {
            $point = $item['point'];
            $id_location = $item['id_location'];
            $type = $item['type'];
            $list_teacher_live = json_decode($item['list_teacher'],true);


            if (isset($_GET['min']) && (is_numeric($_GET['min']))){
                $min = (float) $_GET['min'];
                if ($point < $min ){
                    continue;
                }
            }

            if (isset($_GET['max']) && (is_numeric($_GET['max']))){
                $max = (float) $_GET['max'];
                if ($point > $max ){
                    continue;
                }
            }

            if (isset($_GET['location'])){
                $location = $_GET['location'];
                $location = json_decode($location,true);
                if (! in_array($id_location,$location)){
                    continue;
                }
            }

            if (isset($_GET['type'])){
                $type_filter = $_GET['type'];
                $type_filter = json_decode($type_filter,true);
                if (! in_array($type,$type_filter)){
                    continue;
                }
            }

            if (isset($_GET['teacher'])){
                $teacher_filter = $_GET['teacher'];
                $teacher_filter = json_decode($teacher_filter,true);

                $led = false;
                for ($i = 0; $i < count($list_teacher_live); $i++) {
                    $mono_id_teacher = (string) $list_teacher_live[$i];
                    if (in_array($mono_id_teacher,$teacher_filter)){
                        $led = true;
                    }
                }
                if ( !$led ) continue;
            }

            // ============ get list area

            if (isset($_GET['area'])){
                $area = $_GET['area'];
                $area = json_decode($area,true);

                $list_id_location_filter = array();
                foreach ($area as $area_mono) {
                    $res_location = $this->feedback->get_list_location($area_mono);
                    foreach ($res_location as $item_location) {
                        $id_location_this = $item_location['id'];
                        array_push($list_id_location_filter,$id_location_this);
                    }
                }

                if (! in_array($id_location,$list_id_location_filter)){
                    continue;
                }
            }

            array_push($class_info,$item);
        }

        foreach ($class_info as &$mono_class_info){
            $time_start = $mono_class_info['time_start'];
            $time_end = $mono_class_info['time_end'];
            $mono_class_info['time_start_client'] = date('Y-m-d'.'\T'."H:i",$time_start); // 2000-01-01T00:00:00
            $mono_class_info['time_end_client'] = date('Y-m-d'.'\T'."H:i",$time_end);

            $mono_class_info['number_feedback'] = $this->feedback->get_number_feedback_by_class_code($mono_class_info['class_code']);
        }

        $teacher_info = $this->feedback->get_list_info_teacher();
        $location_info = $this->feedback->get_list_location();


        $teacher_id_to_name = array();
        for ($k = 0; $k < count($teacher_info) ; $k++) {
            $id_teacher = $teacher_info[$k]['teacher_id'];
            $teacher_id_to_name[$id_teacher] =  $teacher_info[$k]['name'];
        }

        $data = array(
            'class_info' => $class_info,
            'teacher_info' => $teacher_info,
            'location_info' => $location_info,
            'teacher_id_to_name' => $teacher_id_to_name,
        );

//        echo '<pre>';
//        print_r($class_info);
//        echo '</pre>';
//        exit;

        $this->load->layout('feedback/class',$data,false,'layout_feedback');
    }

    public function location(){
        $this->guard();


        $this->load->model('Feedback_model', 'feedback');
        $location_info = $this->feedback->get_list_location();

        $data = array(
            'location_info' => $location_info,
//            'teacher_info' => $teacher_info,
//            'teacher_id_to_name' => $teacher_id_to_name,
        );
        $this->load->layout('feedback/location',$data,false,'layout_feedback');
    }

    public function statistic($class_code){
        $this->guard();


        $this->load->model('Feedback_model', 'feedback');
        if (! $this->feedback->check_class_code_exist($class_code)){
            echo 'Mã lớp không hợp lý'; exit;
        }

        $data_single = $this->feedback->get_data_statistic_class($class_code);

        $data = array(
            'singleview'  => $data_single['question'],
            'time'  => $data_single['time'],
        );

        $time_list = $data_single['time'];
        // Time trung bình
        $total_time = 0;
        foreach ($time_list as $time_mono){
            $total_time += $time_mono;
        }
        $average_time = round($total_time/(count($time_list)),1);


        $this->load->layout('feedback/report/report_class', array(
            'data' => $data,
            'name_list' => $data_single['name'],
            'time_list' => $time_list,
            'class_code' => $class_code,
            'average_time' => $average_time,

        ),false,'layout_feedback');

    }

    private function test_chart(){
        $this->guard();


        $res = $this->load->view('feedback/test_chart','',true);
        echo $res;
    }

    // API
    public function request(){
        if ($this->check_login() !== true){
            echo 'wrong token';
            exit;
        }
        $this->load->model('Feedback_model', 'feedback');
        var_dump($_POST);
        // check security

        if (isset($_POST['optcod'])){
            switch ($_POST['optcod']){
                case 'insert_teacher':
                    $aland = 0;
                    $giaotiep = 0;
                    $toeic = 0;
                    $ielts = 0;
                    if (strip_tags($_POST['teacher_giaotiep_insert']) === 'true'){
                        $giaotiep = 1;
                    }
                    if (strip_tags($_POST['teacher_toeic_insert']) === 'true'){
                        $toeic = 1;
                    }
                    if (strip_tags($_POST['teacher_ielts_insert']) === 'true'){
                        $ielts = 1;
                    }
                    if (strip_tags($_POST['teacher_aland_insert']) === 'true'){
                        $aland = 1;
                    }
                    $info = array(
                        'name' => strip_tags($_POST['name_teacher_insert']),
                        'info' => strip_tags($_POST['info_teacher_insert']),
                        'giaotiep' => $giaotiep,
                        'toeic' => $toeic,
                        'ielts' => $ielts,
                        'aland' => $aland,
                        'avatar' => ''
                    );
                    $this->feedback->insert_teacher($info);
                    break;
                case 'edit_teacher':

                    $giaotiep = 0;
                    $toeic = 0;
                    $ielts = 0;
                    if (strip_tags($_POST['teacher_giaotiep_insert']) === 'true'){
                        $giaotiep = 1;
                    }
                    if (strip_tags($_POST['teacher_toeic_insert']) === 'true'){
                        $toeic = 1;
                    }
                    if (strip_tags($_POST['teacher_ielts_insert']) === 'true'){
                        $ielts = 1;
                    }
                    if (strip_tags($_POST['teacher_aland_insert']) === 'true'){
                        $aland = 1;
                    }
                    $info = array(
                        'teacher_id' => (int) strip_tags($_POST['teacher_id']),
                        'name' => strip_tags($_POST['name_teacher_insert']),
                        'info' => strip_tags($_POST['info_teacher_insert']),
                        'giaotiep' => $giaotiep,
                        'toeic' => $toeic,
                        'ielts' => $ielts,
                        'aland' => $aland,
                        'avatar' => ''
                    );

                    $this->feedback->update_teacher($info);
                    break;
                case 'del_teacher':
                    $info = array(
                        'teacher_id' => (int) strip_tags($_POST['teacher_id']),
                    );
                    var_dump($info);
                    $this->feedback->del_teacher($info);
                    break;
                case 'insert_class':
                    // change time date to timestamp
                    $time_start =  strip_tags($_POST['class_from_date']);
                    //  $time_start = strftime('%Y-%m-%dT%H:%M:%S', strtotime($time_start));

                    $time_start = strtotime($time_start);
                    $time_end = strip_tags($_POST['class_to_date']);
                    $time_end = strtotime($time_end);

                    $info = array(
                        'type' => strip_tags($_POST['class_type']),
                        'class_code' => strip_tags($_POST['class_code']),
                        'id_location' => (int) strip_tags($_POST['id_location']),
                        'list_teacher' => json_encode($_POST['class_teacher']),
                        'more_info' => strip_tags($_POST['class_more_info']),
                        'time_start' => $time_start,
                        'time_end' => $time_end,
                    );
                    $this->feedback->insert_class($info);
//                    var_dump($info);

                    break;
                case 'edit_class':
                    $time_start =  strip_tags($_POST['class_from_date']);
                    $time_start = strtotime($time_start);
                    $time_end = strip_tags($_POST['class_to_date']);
                    $time_end = strtotime($time_end);

                    $info = array(
                        'class_id' => strip_tags($_POST['class_id']),
                        'type' => strip_tags($_POST['class_type']),
                        'class_code' => strip_tags($_POST['class_code']),
                        'id_location' => (int) strip_tags($_POST['id_location']),
                        'list_teacher' => json_encode($_POST['class_teacher']),
                        'more_info' => strip_tags($_POST['class_more_info']),
                        'time_start' => $time_start,
                        'time_end' => $time_end,
                    );
                    $this->feedback->update_class($info);
                    break;
                case 'del_class':
                    $info = array(
                        'class_id' => (int) strip_tags($_POST['class_id']),
                    );
                    $this->feedback->del_class($info);
                    break;
                case 'insert_location':
                    $info = array(
                        'name' => strip_tags($_POST['name_location_insert']),
                        'area' => strip_tags($_POST['area'])
                    );
                    $this->feedback->insert_location($info);
                    break;
                case 'edit_location':
                    $info = array(
                        'id' => strip_tags($_POST['id']),
                        'name' => strip_tags($_POST['name_location_insert']),
                        'area' => strip_tags($_POST['area'])
                    );
                    $this->feedback->edit_location($info);
                    break;
                case 'del_location':
                    $info = array(
                        'id' => strip_tags($_POST['id']),
                    );
                    $this->feedback->del_location($info);

                    break;
            }
        }


    }

    // ==========================

    public function giaotiep()
    {
        $this->load->model('Feedback_model', 'feedback');

        $location_info = $this->feedback->get_list_location();
        $arr_location_info = array();
        foreach ($location_info as $mono_location){
            $arr_location_info[$mono_location['id']] = $mono_location['name'] .' - Khu vực ' . $mono_location['area'];
        }


        $info_class = array();
        $list_info_class = array();
        if ( isset($_GET['my_class'])){
            $class_code = mb_strtolower($_GET['my_class']);
            if ($this->feedback->check_class_code_exist($class_code,'giaotiep')){
                $info_class = $this->feedback->get_info_class_by_class_code($class_code);
            }
        }else{
            $list_info_class = $this->feedback->get_list_class_code_opening('giaotiep');
        }

        $list_quest_ruler = array(
            'Về Giảng viên' => array(
                'Trình độ chuyên môn',
                'Phương pháp giảng dạy',
                'Mức độ quan tâm học viên',
                'Mức độ truyền cảm hứng',
                'Mức độ tăng khả năng giao tiếp',
            ),

            'Về Giáo trình và Slides' => array(
                'Bố cục trình bày',
                'Mức độ kiến thức',
            ),
            'Đội ngũ trợ giảng' => array(
                'Mức độ đánh giá buổi offline',
                'Thái độ chăm sóc học viên',
                'Trình độ chuyên môn',
            ),
            'Đội ngũ tư vấn' => array(
                'Tư vấn đầy đủ lộ trình, nội dung, quy định của khóa học',
                'Tư vấn về các chương trình khuyến mãi, hoạt động ngoại khóa (nếu có), phát đầy đủ tài liệu',
                'Thái độ chăm sóc học viên, hỗ trợ học viên qua Group Facebook',
                'Thông báo lịch học, lịch thi, lịch nghỉ học, xếp lịch học bù kịp thời',
            ),
            'Cơ sở vật chất' => array(
                'Chất lượng về cơ sở vật chất',
            ),
        );


        $list_quest_select = array(
            'Giáo viên',
            'Tư vấn',
            'Slides và giáo trình',
        );

        $list_quest_text = array(
            'Đóng góp ý kiến cụ thể để nâng cao chất lượng đào tạo và dịch vụ tại Ms Hoa Giao Tiếp',
        );

        $list_quest_radio = array(
            'Bạn có muốn tiếp tục học tại Ms Hoa Giao Tiếp ở Level cao hơn không?',
        );

        $time_start = time();

        $token_feedback = $this->config->item('token_feedback');
        $token = md5($token_feedback . $time_start);



        $data = array(
          'type_class' =>   'giaotiep',
          'time_start' =>   $time_start,
          'token' =>   $token,
          'info_class' =>   $info_class,
          'list_info_class' =>   $list_info_class,
          'list_quest_ruler' =>   $list_quest_ruler,
          'list_quest_select' =>   $list_quest_select,
          'list_quest_text' =>   $list_quest_text,
          'list_quest_radio' =>   $list_quest_radio,
        );
        
        $this->load->view('feedback/feedback_giaotiep', $data, false);
    }

    public function ielts()
    {


        $this->load->model('Feedback_model', 'feedback');
        $location_info = $this->feedback->get_list_location();
        $arr_location_info = array();
        foreach ($location_info as $mono_location){
            $arr_location_info[$mono_location['id']] = $mono_location['name'] .' - Khu vực ' . $mono_location['area'];
        }

        $info_class = array();
        $list_info_class = array();
        if ( isset($_GET['my_class'])){
            $class_code = mb_strtolower($_GET['my_class']);
            if ($this->feedback->check_class_code_exist($class_code,'ielts')){
                $info_class = $this->feedback->get_info_class_by_class_code($class_code);
            }
        }else{
            $list_info_class = $this->feedback->get_list_class_code_opening('ielts');
        }

        $list_quest_ruler = array(
            'Về Giảng viên' => array(
                'Trình độ chuyên môn',
                'Phương pháp giảng dạy',
                'Mức độ quan tâm học viên',
                'Mức độ truyền cảm hứng',
                'Mức độ tăng khả năng giao tiếp',
            ),

            'Về Giáo trình và Slides' => array(
                'Bố cục trình bày',
                'Mức độ kiến thức',
            ),

            'Đội ngũ tư vấn' => array(
                'Tư vấn đầy đủ lộ trình, nội dung, quy định của khóa học',
                'Tư vấn về các chương trình khuyến mãi, hoạt động ngoại khóa (nếu có), phát đầy đủ tài liệu',
                'Thái độ chăm sóc học viên, hỗ trợ học viên qua Group Facebook',
                'Thông báo lịch học, lịch thi, lịch nghỉ học, xếp lịch học bù kịp thời',
            ),
            'Cơ sở vật chất' => array(
                'Chất lượng về cơ sở vật chất',
            ),
        );


        $list_quest_select = array(
            'Giáo viên',
            'Tư vấn',
        );

        $list_quest_text = array(
            'Đóng góp ý kiến cụ thể để nâng cao chất lượng đào tạo và dịch vụ tại IELTS Fighter',
        );

        $list_quest_radio = array(
            'Bạn có muốn tiếp tục học tại IELTS Fighter ở Level cao hơn không?',
        );

        $time_start = time();

        $token_feedback = $this->config->item('token_feedback');
        $token = md5($token_feedback . $time_start);



        $data = array(
            'type_class' =>   'ielts',
            'time_start' =>   $time_start,
            'token' =>   $token,
            'info_class' =>   $info_class,
            'list_info_class' =>   $list_info_class,
            'list_quest_ruler' =>   $list_quest_ruler,
            'list_quest_select' =>   $list_quest_select,
            'list_quest_text' =>   $list_quest_text,
            'list_quest_radio' =>   $list_quest_radio,
            'arr_location_info' =>   $arr_location_info,
        );

        $this->load->view('feedback/feedback_ielts', $data, false);
    }

    public function toeic()
    {
        $this->load->model('Feedback_model', 'feedback');

        $location_info = $this->feedback->get_list_location();
        $arr_location_info = array();
        foreach ($location_info as $mono_location){
            $arr_location_info[$mono_location['id']] = $mono_location['name'] .' - Khu vực ' . $mono_location['area'];
        }

        $info_class = array();
        $list_info_class = array();
        if ( isset($_GET['my_class'])){
            $class_code = mb_strtolower($_GET['my_class']);
            if ($this->feedback->check_class_code_exist($class_code,'toeic')){
                $info_class = $this->feedback->get_info_class_by_class_code($class_code);
            }
        }else{
            $list_info_class = $this->feedback->get_list_class_code_opening('toeic');
        }

        $list_quest_ruler = array(
            'Về Giảng viên' => array(
                'Trình độ chuyên môn',
                'Phương pháp giảng dạy',
                'Mức độ quan tâm học viên',
                'Mức độ truyền cảm hứng',
                'Mức độ tăng kỹ năng làm bài',
            ),

            'Về nội dung Giáo trình và Slides' => array(
                'Tính chính xác, khoa học về nội dung kiến thức, chính tả, từ ngữ…',
                'Ngắn gọn nhưng đầy đủ nội dung và làm nổi bật được trọng tâm của bài học',
                'Kiến thức được tổ chức có hệ thống và thể hiện được tính kết nối',
            ),
            'Về hình thức Giáo trình và Slides' => array(
                'Giao diện đảm bảo chuyên nghiệp, hệ thống và tính nhất quán. Phông nền hài hòa với chữ, màu sắc và nội dung',
                'Chữ và các công thức/mẫu câu được thiết kế thống nhất, cân đối; các phương tiện trực quan (phim, mô phỏng, hình ảnh) có chất lượng tốt, đẹp mắt, hài hòa',
                'Có sự phối hợp hài hòa, khoa học màu sắc trong toàn bộ bài giảng.',
                'Hệ thống hiệu ứng phù hợp (Các hiệu ứng hình ảnh, màu sắc, âm thanh, chuyển động được sử dụng hợp lí)',
            ),

            'Tương tác giữa Giáo viên và Slides' => array(
                'Giải thích, giảng giải đầy đủ các đầu mục kiến thức trong slides; phân bổ thời gian hợp lí cho từng phần, từng khâu',
                'Phối hợp nhịp nhàng giữa slides và ghi bảng, với hoạt động tương tác giữa học viên và giáo viên',
                'Nhịp độ trình chiếu và triển khai bài dạy vừa phải, phù hợp với việc ghi chép và sự tiếp thu của học viên',
            ),
            'Đội ngũ tư vấn' => array(
                'Tư vấn đầy đủ lộ trình, nội dung, quy định của khóa học',
                'Tư vấn về các chương trình khuyến mãi, hoạt động ngoại khóa (nếu có), phát đầy đủ tài liệu',
                'Thái độ chăm sóc học viên, hỗ trợ học viên qua Group Facebook',
                'Thông báo lịch học, lịch thi, lịch nghỉ học, xếp lịch học bù kịp thời',
            ),
            'Cơ sở vật chất' => array(
                'Chất lượng về cơ sở vật chất',
            ),
        );


        $list_quest_select = array(
            'Giáo viên',
            'Tư vấn',
            'Slides và giáo trình',
        );

        $list_quest_text = array(
            'Đóng góp ý kiến cụ thể để nâng cao chất lượng đào tạo và dịch vụ tại Ms Hoa TOEIC',
        );

        $list_quest_radio = array(
            'Bạn có muốn tiếp tục học tại Ms Hoa TOEIC ở Level cao hơn không?',
        );

        $time_start = time();

        $token_feedback = $this->config->item('token_feedback');
        $token = md5($token_feedback . $time_start);



        $data = array(
            'type_class' =>   'toeic',
            'time_start' =>   $time_start,
            'token' =>   $token,
            'info_class' =>   $info_class,
            'list_info_class' =>   $list_info_class,
            'list_quest_ruler' =>   $list_quest_ruler,
            'list_quest_select' =>   $list_quest_select,
            'list_quest_text' =>   $list_quest_text,
            'list_quest_radio' =>   $list_quest_radio,
            'arr_location_info' =>   $arr_location_info,
        );

        $this->load->view('feedback/feedback_toeic', $data, false);

    }

    public function aland()
    {
        $this->load->model('Feedback_model', 'feedback');
        $location_info = $this->feedback->get_list_location();
        $arr_location_info = array();
        foreach ($location_info as $mono_location){
            $arr_location_info[$mono_location['id']] = $mono_location['name'] .' - Khu vực ' . $mono_location['area'];
        }

        $info_class = array();
        $list_info_class = array();
        if ( isset($_GET['my_class'])){
            $class_code = mb_strtolower($_GET['my_class']);
            if ($this->feedback->check_class_code_exist($class_code,'ielts')){
                $info_class = $this->feedback->get_info_class_by_class_code($class_code);
            }
        }else{
            $list_info_class = $this->feedback->get_list_class_code_opening('ielts');
        }

        $list_quest_ruler = array(
            'Về Giảng viên' => array(
                'Trình độ chuyên môn',
                'Phương pháp giảng dạy',
                'Mức độ quan tâm học viên',
                'Mức độ truyền cảm hứng',
                'Mức độ tăng khả năng giao tiếp',
            ),

            'Về Giáo trình và Slides' => array(
                'Bố cục trình bày',
                'Mức độ kiến thức',
            ),

            'Đội ngũ tư vấn' => array(
                'Tư vấn đầy đủ lộ trình, nội dung, quy định của khóa học',
                'Tư vấn về các chương trình khuyến mãi, hoạt động ngoại khóa (nếu có), phát đầy đủ tài liệu',
                'Thái độ chăm sóc học viên, hỗ trợ học viên qua Group Facebook',
                'Thông báo lịch học, lịch thi, lịch nghỉ học, xếp lịch học bù kịp thời',
            ),
            'Cơ sở vật chất' => array(
                'Chất lượng về cơ sở vật chất',
            ),
        );


        $list_quest_select = array(
            'Giáo viên',
            'Tư vấn',
        );

        $list_quest_text = array(
            'Đóng góp ý kiến cụ thể để nâng cao chất lượng đào tạo và dịch vụ tại IELTS Fighter',
        );

        $list_quest_radio = array(
            'Bạn có muốn tiếp tục học tại IELTS Fighter ở Level cao hơn không?',
        );

        $time_start = time();

        $token_feedback = $this->config->item('token_feedback');
        $token = md5($token_feedback . $time_start);



        $data = array(
            'type_class' =>   'ielts',
            'time_start' =>   $time_start,
            'token' =>   $token,
            'info_class' =>   $info_class,
            'list_info_class' =>   $list_info_class,
            'list_quest_ruler' =>   $list_quest_ruler,
            'list_quest_select' =>   $list_quest_select,
            'list_quest_text' =>   $list_quest_text,
            'list_quest_radio' =>   $list_quest_radio,
            'arr_location_info' =>   $arr_location_info,
        );

        $this->load->view('feedback/feedback_aland', $data, false);
    }

    // ==========================

    private function _mark_all_class($type = ''){
        $this->load->model('Feedback_model', 'feedback');
        $this->feedback->mark_point_all_class($type);
    }

    // ========================== Receive feedback
    public function send_feedback()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        echo 'start check token';
        $this->load->model('Feedback_model', 'feedback');
        if ( $this->check_token() ) {
            if ( $this->_validate() ) {
                $info = array(
                    'type' => strip_tags($this->input->post('type')), //   ieltsfighter - giaotiep - toiec
                    'class_code' => strip_tags($this->input->post('class_code')), //
                    'time_start' => (int)strip_tags($this->input->post('time_start')),
                    'detail' => strip_tags($this->input->post('detail')),
                    'name_feeder' => strip_tags($this->input->post('name_feeder')),
                );
                echo 'ABC';
                $this->feedback->insert_feedback_paper($info);
                echo 'Ok';
            }
        } else {
            echo 'Wrong token';
            exit;
        }
    }

    // ========================== Underground
    private function _validate()
    {
        $this->load->model('Feedback_model', 'feedback');
        if (isset($_POST['class_code'])) {
            // check class code exist or in time
            $res = $this->feedback->check_class_feedback_openning($_POST['class_code']);
            return $res;
        }
        return false;
    }

    private function check_token()
    {
        if (isset($_POST['token']) && (isset($_POST['time_start']))) {


            $token_feedback = $this->config->item('token_feedback');
            $token_formal = md5($token_feedback . $_POST['time_start']);
            if ($token_formal === $_POST['token']) {
                return true;
            }
        }
        return false;
    }

}
