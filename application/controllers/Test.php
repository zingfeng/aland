<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller{

    function __construct(){
		parent::__construct();
	}
    public function index(){
        $this->load->model('news_model','news');
        $param = array(
            "category_id" => 3499,
            "limit" => 3,
        );
        $data['arrNews'] = $this->news->lists_by_cate_rule1($param);
        $this->load->layout('test/index', $data);
    }

    public function skill($type) {
        $this->load->model('test_model','test');
        $this->load->model('news_model','news');
        $page = (int)$this->input->get('page');
        $params['limit'] = 12; $params['offset'] = 0;
        // get test by cate
        $params['isclass'] = 0;
        switch ($type) {
            case 'listening':
                $params['type'] = 1;
                $cate_news = 3511;
                break;
            case 'reading':
                $params['type'] = 2;
                $cate_news = 3515;
                break;
            case 'writing':
                $params['type'] = 3;
                $cate_news = 3516;
                break;
            case 'speaking':
                $params['type'] = 4;
                $cate_news = 3517;
                break;
            default:
                $cate_news = 3499;
                break;
        }
        $data['rows'] = $this->test->get_test_by_type($params);
        $data['type'] = $type;
        $data['arrNews'] = $this->news->lists_by_cate_rule1(array('category_id' => $cate_news, "limit" => 3));

        $this->load->layout('test/skill', $data);
    }

    public function lists($cateid) { 
        $cateid = (int) $cateid;
        $this->load->model('test_model','test');
        $this->load->model('category_model','category'); 
        // get cate detail
        $cate = $this->category->detail($cateid);
        $url = $this->uri->uri_string();
        if ($url != trim($cate['share_url'],'/')){
            redirect($cate['share_url'],'location','301');
        }
        $this->load->setData('seo_title',($cate['seo_title']) ? $cate['seo_title'] : $cate['name']);
        $this->load->setData('meta',array(
            'keyword' => ($cate['seo_keyword']) ? $cate['seo_keyword'] : $cate['name'],
            'description' => ($cate['seo_description']) ? $cate['seo_description'] : $cate['description']
        ));
        $this->load->setData('ogMeta',array(
                'og:image' => getimglink($cate['images']),
                'og:title' => ($cate['seo_title']) ? $cate['seo_title'] : $cate['name'],
                'og:description' => ($cate['seo_description']) ? $cate['seo_description'] : $cate['description'],
                'og:url' => current_url())
        );
        //Load list test
        $limit = 10;
        $this->load->model('test_model','test');
        $page = (int)$this->input->get('page');
        $page = ($page > 1) ? $page : 1;
        $offset = ($page - 1) * $limit;
        $params['limit'] = $limit; $params['offset'] = $offset;
        $params['time'] = ($times == 0) ? 0 : 1;
        $params['cate_id'] = $cateid;
        $config['total_rows'] = $this->test->get_total_by_cate($params);
        if ($config['total_rows'] < 1){
            return $this->load->layout('common/noresult');
        }
        $config['per_page'] = $limit;
        $this->load->library('pagination',$config);
        $data['paging'] =  $this->pagination->create_links();

        // get test by cate
        $params = array_merge(array('isclass' => 0), $params);

        $data['rows'] = $this->test->get_test_by_cate($params); 
        $data['cate'] = $cate;

        if($data['rows']){
            $this->load->config("data");
            $arr_test_type = $this->config->item('test_type');
            foreach ($data['rows'] as $key => $test) {
                foreach ($arr_test_type as $type_id => $type_name) {
                    // Check question
                    $arrQuestion = $this->test->get_question_by_test(array('test_id' => $test['test_id'], 'type' => $type_id, 'limit' => 200));
                    if($arrQuestion){
                        $data['rows'][$key]['test_list'][] = $type_name;
                    }
                }
            }
        }

        $breadcrumb = array(array('name' => $cate['name'],'link' => $cate['share_url']));
        $this->config->set_item("breadcrumb",$breadcrumb);
        /// set config
        $this->config->set_item("mod_access",array("name" => "test_list"));
        $this->config->set_item("menu_select",array('item_mod' => 'test_list', 'item_id' => $cateid,'item_type' => $cate['type']));
        // render view
        $this->load->layout('test/lists',$data);
    }
    public function class_home(){
        $classDetail = $this->permission->getClassIdentity();
        /// GET ARTICLE BY CLASS //////
        $this->load->model('news_model','news');
        $this->load->model('category_model','category');
        $arrNews = $this->news->list_for_class($classDetail['class_id'],array('limit' => 6));
        /// get all cate video
        $arrCategory = $this->category->get_category(array('type' => 1,'style' => 2));
        foreach ($arrCategory as $key => $cate) {
            $arrCateId[] = $cate['cate_id'];
        }

        $arrVideo = $this->news->list_for_class($classDetail['class_id'],array('limit' => 6, 'cate' => $arrCateId));

        $data = array(
            'arrNews' => $arrNews,
            'arrVideo' => $arrVideo,
            'classDetail' => $classDetail
        );
        $this->config->set_item("mod_access",array("name" => "class_test"));
        $this->config->set_item("menu_select",array('item_mod' => 'class_test'));
        $this->load->layout('test/class_home',$data);
    }
    public function class_list($type = 0,$times = 0){
        $classDetail = $this->permission->getClassIdentity();
        //print_r($this->session->userdata);
        $limit = 10; $cate_id = intval($cate_id);
        $this->load->model('test_model','test');
        $page = (int)$this->input->get('page');
        $page = ($page > 1) ? $page : 1;
        $offset = ($page - 1) * $limit;
        $option['limit'] = $limit; $option['offset'] = $offset;
        $option['time'] = ($times == 0) ? 0 : 1;
        $option['type'] = $type;
        $config['total_rows'] = $this->test->count_list_for_class($classDetail['class_id'],$option);
        if ($config['total_rows'] < 1){
            return $this->load->layout('common/noresult');
        }
        $config['per_page'] = $limit;
        $this->load->library('pagination',$config);
        $data['paging'] =  $this->pagination->create_links();
        $data['rows'] = $this->test->list_for_class($classDetail['class_id'],$option);
        $data['classDetail'] = $classDetail;

        $this->config->set_item("breadcrumb",array(array("name" => 'Bài tập test lớp',"link" => SITE_URL. '/bai-tap-lop.html')));

        $this->config->set_item("mod_access",array("name" => "class_test"));
        $this->config->set_item("menu_select",array('item_mod' => 'class_test'));

        $this->load->layout('test/class_list',$data);
    }
    public function detail($test_id,$type){
        /////////// CHECK PERMISSION ////////
        $test_id = (int) $test_id;
        $this->load->config("data");
        $keyType = array_search ($type, array_map('strtolower', $this->config->item('test_type')));
        $this->load->model('test_model','test');
        $this->load->model('category_model','category');
        // get detail test
        $testDetail = $this->test->get_test_detail(array('test_id' => $test_id));
        ///////// get category //////////
        $cateDetail = $this->category->detail($testDetail['original_cate']);
        //Check user login
        if(!($user_id = $this->permission->getId())){
        	$redirect_uri = current_url();
        	if($queryString = $_SERVER['QUERY_STRING']){
        		$redirect_uri .= '?'.$queryString;
        	}
            $redirect_uri = SITE_URL.'/users/login?redirect_uri='.urlencode($redirect_uri);
            redirect($redirect_uri);
        }

        if (empty($testDetail)){
            show_404();
        }
        ///////// CHECK CLASS ////////
        $arrQuestion = $this->test->get_question_by_test(array('test_id' => $test_id,'type' => $keyType, 'limit' => 200));
        //var_dump($arrQuestion); die;
        if (empty($arrQuestion)){
            show_404();
        }

        foreach ($arrQuestion as $key => $questionDetail) {
            $arrQuestionId[] = $questionDetail['question_id'];
        }

        $arrQuestionGroup = $this->test->get_question_group(array('parent_id' => $arrQuestionId));

        $start_time = time();
        ///////// GET DETAIL
        $data = array('keyType' => $keyType,
            'test' => $testDetail,
            'cateDetail' => $cateDetail,
            'arrQuestion' => $arrQuestion,
            'arrQuestionGroup' => $arrQuestionGroup,
            'start_time' => $start_time,
            'token' => '123'
        );


        /////// Test type ///////
        $arr_list_test_type = array();
        $this->load->config("data");
        $arr_test_type = $this->config->item('test_type');
        foreach ($arr_test_type as $type_id => $type_name) {
            // Check question
            $arrQuestion = $this->test->get_question_by_test(array('test_id' => $test_id, 'type' => $type_id, 'limit' => 200));
            if($arrQuestion){
                $arr_list_test_type[] = $type_name;
            }
        }
        $data['arr_list_test_type'] = $arr_list_test_type;

        //////////////////////////////
        //////////////////////////////
        //////////////////////////////

        if (! $this->input->get('skill')) {
            // Lấy thêm thông tin bài test
            if ($this->input->post('fulltest_timestamp')) {
                // Timestamp Exist
                $fulltest_timestamp = $this->input->post('fulltest_timestamp');
                $fulltest_all_step = unserialize($this->input->post('fulltest_all_step'));
                $fulltest_now_step = (int) $this->input->post('fulltest_now_step');



                // Mặc định:
                $arr_fulltest_all_detail = array(
                    'fulltest_timestamp' => $fulltest_timestamp,
                    'fulltest_all_step' => serialize($fulltest_all_step),
                    'fulltest_now_step' => $fulltest_now_step,
                );
            } else {
//                // generate fulltest timestamp
                $fulltest_all_step = array();
                foreach ($arr_list_test_type as $type_fcking) {
                    $fulltest_all_step[] = str_replace('/test/', '/test/' . trim(strtolower($type_fcking)) . '/', $testDetail['share_url']);
                }
                $arr_fulltest_all_detail = array(
                    'fulltest_timestamp' => time(),
                    'fulltest_all_step' => serialize($fulltest_all_step),
                    'fulltest_now_step' => 0,
                );
                // Nếu full test có 1 kỹ năng thì chuyển thành mono test
                if (count($fulltest_all_step) == 1){
                    redirect($_SERVER['REQUEST_URI'].'?skill=1','auto',301);
                }

            }
        }
        if (isset($arr_fulltest_all_detail)) $data['arr_fulltest_all_detail'] = $arr_fulltest_all_detail;

        //////////////////////////////
        //////////////////////////////
        //////////////////////////////

        /////// SEO //////
        $this->load->setData('title',$testDetail['title'] .' -' .$type);
        $this->load->setData('meta',array(
            'keyword' => $testDetail['title'],
            'description' => cut_text($testDetail['description'],300)
        ));
        $this->load->setData('ogMeta',array(
                'og:image' => getimglink($testDetail['images']),
                'og:title' => $testDetail['title'],
                'og:description' => $testDetail['description'],
                'og:url' => current_url())
        );

        $this->config->set_item("breadcrumb",array(array('name' => $cateDetail['name'],'link' => $cateDetail['share_url']),array("name" => $testDetail['title'])));

        return $this->load->layout('test/'.$type,$data,FALSE,'layout_test');  
    }
    public function writing_result() {
        $this->load->model('test_model','test');
        $this->load->model('category_model','category');
        $test_id = (int) $this->input->post('test_id');
        $type = (int) $this->input->post('type');
        $start_time = $this->input->post('start_time');
        $user_answer = $this->input->post('user_answer');

        $this->load->config("data");
        // update count hit
        $this->test->incre_hit(array('test_id' => $test_id));

        if(!($testDetail = $this->test->get_test_detail(array('test_id' => $test_id)))) {
            show_404();
        }
        //Test relate
        // =============================================
        $arrTestRelate = $this->test->get_test_by_cate_by_type(array('excluse' => $test_id,'cate_id' => $testDetail['original_cate'],'type'=>3));
        // =============================================
        // =============================================

        $arrUserAnswer = $this->input->post('user_answer');

        if (!is_array($arrUserAnswer)) {
            $arrUserAnswer = @json_decode($arrUserAnswer,TRUE);
        }
        $cateDetail = $this->category->detail($testDetail['original_cate']);
        $arrParentQuestion = $this->test->get_question_by_test(array('test_id' => $test_id,'type' => $type, 'parent' => 0, 'limit' => 200));
        if (empty($arrParentQuestion)){
            show_404();
        }
        $total_time = 0;

        $arrParentId = array();
        foreach ($arrParentQuestion as $key => $questionDetail) {
            $arrParentId[] = $questionDetail['question_id'];
            $total_time += $questionDetail['test_time'];
        }
        $arrQuestion = $this->test->get_question_group(array('parent_id' => $arrParentId));
        $arrQuestion =  array_shift($arrQuestion);
        //Get Vocabulary
        if($arrQuestion){
            $this->load->model('dictionary_model','dictionary');
            foreach ($arrQuestion as $key => $question) {
                if($question['question_answer']){
                    foreach ($question['question_answer'] as $key2 => $answer) {
                        $arr_dict = json_decode($answer['dictionary'], TRUE);
                        if($arr_dict){
                            $arrQuestion[$key]['question_answer'][$key2]['dict'] = $this->dictionary->lists(array('arr_dict' => $arr_dict));
                        }
                    }
                }
            }
        }

        //Test
        $userData = $this->permission->getIdentity();
        if ($this->input->post('fulltest_timestamp')) {
            $fulltest_timestamp_log =  (int) $this->input->post('fulltest_timestamp');
        }else{
            $fulltest_timestamp_log = 0;
        }

        $status = 0;
        //Trường hợp là fulltest thì auto gửi yêu cầu chấm điểm
        if($this->input->post('fulltest_timestamp')){
            $status = 1;
        }

        $test_log_id = $this->test->test_logs_insert(array('test_id' => $test_id, 'user_id' => (int) $userData['user_id'], 'test_type' => $type, 'start_time' => $start_time,'end_itme' => time(), 'score_detail' => array('answer_list' => $arrUserAnswer), 'answer_list' => $arrUserAnswer, 'status' => $status, 'timestamp_fulltest' => $fulltest_timestamp_log));
        ///// Gramaly check
        $gramaly = array();
        if($user_answer){
            foreach ($user_answer as $question_id => $answer) {
                $urlInfo = 'https://api.textgears.com/check.php?text='.urlencode($answer).'&key='.$this->config->item('textgears_key');
                $this->load->library('Curl', 'curl');
                $response = json_decode($this->curl->simple_get($urlInfo), TRUE);
                if($response['result'] == TRUE && $response['errors']){
                    $gramaly[$question_id] = $response['errors'];
                }
            }
        }
        $user_answer = gramar_check($user_answer, $gramaly);

        $data = array(
            'testDetail' => $testDetail,
            'test_log_id' => $test_log_id,
            'type' => $type,
            'total_question' => $total_question,
            'arrQuestion' => $arrQuestion,
            'arrTestRelate' => $arrTestRelate,
            'gramaly' => $gramaly,
            'userAnswer' => $user_answer,
            'replay_url' => replace_test_link($testDetail['share_url'],3).'?skill=1'
        );

        $this->config->set_item("breadcrumb",array(array('name' => $cateDetail['name'],'link' => $cateDetail['share_url']),array("name" => 'Kết quả test')));
        if ($this->input->post('fulltest_timestamp') ){
            // Full test
            $fulltest_timestamp = $this->input->post('fulltest_timestamp');
            $fulltest_all_step = unserialize($this->input->post('fulltest_all_step'));
            $fulltest_now_step = (int) $this->input->post('fulltest_now_step');

            // Mặc định:
            $arr_fulltest_all_detail = array(
                'fulltest_timestamp' => $fulltest_timestamp,
                'fulltest_all_step' => serialize($fulltest_all_step),
                'fulltest_now_step' => (int) $fulltest_now_step + 1,
            );
            if ($fulltest_now_step >= ( count($fulltest_all_step)-1 ) ){
                return redirect(SITE_URL.'/test/result_fulltest/'.$fulltest_timestamp,'location','301');
            }else{
                $arr_fulltest_all_detail['url'] = $fulltest_all_step[$fulltest_now_step + 1];
                return $this->load->view('common/redirect_post',$arr_fulltest_all_detail,false); 
            }
        }
        return $this->load->layout('test/result_writing',$data);
    }

    public function speaking_result(){
        $this->load->model('test_model','test');
        $this->load->model('category_model','category');
        $test_id = (int) $this->input->post('test_id');
//        $type = (int) $this->input->post('type');
        $type = 4;
        $start_time = (int) $this->input->post('start_time');
        $user_answer = $this->input->post('user_answer');
        $user_answer = json_decode($user_answer,true);

        $answer_sheet_form = $this->input->post('answer_sheet_form');
        $answer_sheet_form = json_decode($answer_sheet_form,true);

        foreach ($answer_sheet_form as $key_ans_sheet => $mono_ans ){

            $new_ans_wtf = array();
            foreach ($mono_ans as $id_ans) {
                if (isset($user_answer[$id_ans])){
                    $new_ans_wtf[$id_ans] = $user_answer[$id_ans];
                }
            }
            $answer_sheet_form[$key_ans_sheet] = $new_ans_wtf;
        }

        $_REQUEST['user_answer'] = $answer_sheet_form;

        $this->load->config("data");
        // update count hit
        $this->test->incre_hit(array('test_id' => $test_id));

        if(!($testDetail = $this->test->get_test_detail(array('test_id' => $test_id)))) {
            show_404();
        }

        //Test relate
        $arrTestRelate = $this->test->get_test_by_cate(array('excluse' => $test_id,'cate_id' => $testDetail['original_cate']));
//        $arrUserAnswer = $this->input->post('user_answer');
        $arrUserAnswer = $answer_sheet_form;

        if (!is_array($arrUserAnswer)) {
            $arrUserAnswer = @json_decode($arrUserAnswer,TRUE);
        }

        $cateDetail = $this->category->detail($testDetail['original_cate']);
        $arrParentQuestion = $this->test->get_question_by_test(array('test_id' => $test_id,'type' => $type, 'parent' => 0, 'limit' => 200));
        if (empty($arrParentQuestion)){
            show_404();
        }
        $total_time = 0;

        $arrParentId = array();
        foreach ($arrParentQuestion as $key => $questionDetail) {
            $arrParentId[] = $questionDetail['question_id'];
            $total_time += $questionDetail['test_time'];
        }

        $arrQuestion = $this->test->get_question_group(array('parent_id' => $arrParentId));
        $arrQuestion =  array_shift($arrQuestion);
        //Get Vocabulary
        if($arrQuestion){
            $this->load->model('dictionary_model','dictionary');
            foreach ($arrQuestion as $key => $question) {
                if($question['question_answer']){
                    foreach ($question['question_answer'] as $key2 => $answer) {
                        $arr_dict = json_decode($answer['dictionary'], TRUE);
                        if($arr_dict){
                            $arrQuestion[$key]['question_answer'][$key2]['dict'] = $this->dictionary->lists(array('arr_dict' => $arr_dict));
                        }
                    }
                }
            }
        }

        //Test
        $userData = $this->permission->getIdentity();

        if ($this->input->post('fulltest_timestamp')) {
            $fulltest_timestamp_log =  (int) $this->input->post('fulltest_timestamp');
        }else{
            $fulltest_timestamp_log = 0;
        }

        $status = 0;
        //Trường hợp là fulltest thì auto gửi yêu cầu chấm điểm
        if($this->input->post('fulltest_timestamp')){
            $status = 1;
        }
        $test_log_id = $this->test->test_logs_insert(array('test_id' => $test_id, 'user_id' => (int) $userData['user_id'], 'test_type' => $type, 'start_time' => $start_time,'end_itme' => time(), 'score_detail' => array('answer_list' => $arrUserAnswer), 'answer_list' => $arrUserAnswer, 'status' => $status, 'timestamp_fulltest' => $fulltest_timestamp_log, 'status' => 0));

        $data = array(
            'testDetail' => $testDetail,
            'test_log_id' => $test_log_id,
            'type' => $type,
            'arrQuestion' => $arrQuestion,
            'arrTestRelate' => $arrTestRelate,
            'userAnswer' => $user_answer,
            'replay_url' => replace_test_link($testDetail['share_url'],3).'?skill=1'
        );

        $this->config->set_item("breadcrumb",array(array('name' => $cateDetail['name'],'link' => $cateDetail['share_url']),array("name" => 'Kết quả test')));

        if ($this->input->post('fulltest_timestamp') ){
            // Full test
            $fulltest_timestamp = $this->input->post('fulltest_timestamp');
            $fulltest_all_step = unserialize($this->input->post('fulltest_all_step'));
            $fulltest_now_step = (int) $this->input->post('fulltest_now_step');

            // Mặc định:
            $arr_fulltest_all_detail = array(
                'fulltest_timestamp' => $fulltest_timestamp,
                'fulltest_all_step' => serialize($fulltest_all_step),
                'fulltest_now_step' => (int) $fulltest_now_step + 1,
            );
            if ($fulltest_now_step >= ( count($fulltest_all_step)-1 ) ){
                return redirect(SITE_URL.'/test/result_fulltest/'.$fulltest_timestamp,'location','301');
            }else{
                $arr_fulltest_all_detail['url'] = $fulltest_all_step[$fulltest_now_step + 1];
                return $this->load->view('common/redirect_post',$arr_fulltest_all_detail,false);
            }
        }

        //
        redirect('/test/send_request/'.$test_log_id.'/'.$this->security->generate_token_post($test_log_id),'auto',301);

//        return $this->load->layout('test/result_speaking',$data);
    }

    public function review_result($log_id, $result) {
        $this->load->model('test_model','test');
        $this->load->model('category_model','category');
        $this->load->config("data");
        ////// get log detail ////////
        $arrLogDetail = $this->test->get_test_logs_detail($log_id);
        //var_dump($arrLogDetail); die;
        /////////// CHECK PERMISSION ////////
        $test_id = (int) $arrLogDetail['test_id'];
        $keyType = $arrLogDetail['test_type'];

        $type = $this->config->item('test_type');
        $type = strtolower($type[$keyType]);
        // get detail test 
        $testDetail = $this->test->get_test_detail(array('test_id' => $test_id));
        ///////// get category //////////
        $cateDetail = $this->category->detail($testDetail['original_cate']);



        /* $userData = $this->permission->getIdentity();
        if ($testDetail['test_time'] > 0 && !$userData) {
            return redirect(SITE_URL.'/users/login?redirect_uri='.current_url(),'refresh');
        }*/
        if (empty($testDetail)){
            show_404();
        }
        ///////// CHECK CLASS ////////
        $arrQuestion = $this->test->get_question_by_test(array('test_id' => $test_id,'type' => $keyType, 'limit' => 200));
        //var_dump($arrQuestion); die;
        if (empty($arrQuestion)){
            show_404();
        }
        
        foreach ($arrQuestion as $key => $questionDetail) {
            $arrQuestionId[] = $questionDetail['question_id'];
        }
        $arrQuestionGroup = $this->test->get_question_group(array('parent_id' => $arrQuestionId));
        //
        $id_question_to_group_question = array();
        $id_answer_to_id_question = array();
        $arr_id_answer_to_group_question = array();
        foreach ($arrQuestionGroup as $id_group_question => $arr_question_inside) {
            foreach ($arr_question_inside as $id_question_inside => $item) {
                $id_question_to_group_question[$id_question_inside] = $id_group_question;
                $question_answer_arr = $item['question_answer'];
                for ($k = 0; $k < count($question_answer_arr); $k++) {
                    // [answer_id] => 44     [question_id] => 84
                    $answer_id_mono = $question_answer_arr[$k]['answer_id'];
                    $question_id = $question_answer_arr[$k]['question_id'];
                    $id_answer_to_id_question[$answer_id_mono] = $question_id;
                }
            }
        }

        foreach ($id_answer_to_id_question as $id_answer => $id_question) {
            $arr_id_answer_to_group_question[$id_answer] = $id_question_to_group_question[$id_question];
        }

        $arrQuestionId = array();
        foreach ($arrQuestionGroup as $key => $questionGroup) {
            $arrQuestionId = array_merge($arrQuestionId,array_keys($questionGroup));
        }

        $arrAnswer = $this->test->get_answer_result_by_question_id($arrQuestionId);
        foreach ($arrAnswer as $key => $answer) {
            $arrAnswerResult[$answer['answer_id']][] = $answer;
        }
        //var_dump($arrAnswerResult); die;
        $start_time = time();
        ///////// GET DETAIL 
        $data = array('keyType' => $keyType,
                        'test' => $testDetail,
                        'arrQuestion' => $arrQuestion,
                        'arrQuestionGroup' => $arrQuestionGroup,
                        'start_time' => $start_time,
                        'token' => '123',
                        'cateDetail' => $cateDetail,
                        'arrLogDetail' => $arrLogDetail,
                        'arrAnswerResult' => $arrAnswerResult,
                        'arr_id_answer_to_group_question' => $arr_id_answer_to_group_question,
        );


        /////// SEO //////
        $this->load->setData('title',$testDetail['title'] .' -' .$type);
        $this->load->setData('meta',array(
            'keyword' => $testDetail['title'],
            'description' => cut_text($testDetail['description'],300)
        ));
        $this->load->setData('ogMeta',array(
                'og:image' => getimglink($testDetail['images']),
                'og:title' => $testDetail['title'],
                'og:description' => $testDetail['description'],
                'og:url' => current_url())
        );

        $this->config->set_item("breadcrumb",array(array('name' => $cateDetail['name'],'link' => $cateDetail['share_url']),array("name" => $testDetail['title']))); 

        return $this->load->layout('test/'.$type.'_review',$data,FALSE, 'layout_test');
    } 
    public function result() {
        $this->load->model('test_model','test');
        $this->load->model('category_model','cate');
        $test_id = (int) $this->input->post('test_id');
        $type = (int) $this->input->post('type');

        $start_time = $this->input->post('start_time');
        $this->load->config("data");
        //////// USSER //////
        $userData = $this->permission->getIdentity();
        // update count hit
        $this->test->incre_hit(array('test_id' => $test_id));
        
        if(!($testDetail = $this->test->get_test_detail(array('test_id' => $test_id)))) {
            show_404();
        }

        //////////// GET TEST RELATE ///////
        $cateDetail = $this->cate->detail($testDetail['original_cate']);
        $arrTestRelate = $this->test->get_test_by_cate(array('excluse' => $test_id,'cate_id' => $testDetail['original_cate']));
        if($arrTestRelate){
            $this->load->config("data");
            $arr_test_type = $this->config->item('test_type');
            foreach ($arrTestRelate as $key => $test) {
                foreach ($arr_test_type as $type_id => $type_name) {
                    // Check question
                    $arrQuestion = $this->test->get_question_by_test(array('test_id' => $test['test_id'], 'type' => $type_id, 'limit' => 200));
                    if($arrQuestion){
                        $arrTestRelate[$key]['test_list'][] = $type_name;
                    }
                }
            }
        }
        //////////////
        $arrUserAnswer = $this->input->post('answer');
        if (!is_array($arrUserAnswer)) {
            $arrUserAnswer = @json_decode($arrUserAnswer,TRUE);
        }

        //////////////////////////// GET Question //
        $arrParentQuestion = $this->test->get_question_by_test(array('test_id' => $test_id,'type' => $type, 'parent' => 0, 'limit' => 200));
        //var_dump($arrQuestion); die;
        if (empty($arrParentQuestion)) {
            show_404();
        }
        $total_time = 0;
        foreach ($arrParentQuestion as $key => $questionDetail) {
            $arrParentId[] = $questionDetail['question_id'];
            $total_time += $questionDetail['test_time'];
        }
        $arrQuestionId = $this->test->get_question_group(array('parent_id' => $arrParentId,'return_question_id_only' => 1));
        
        /// get answer question //
        $arrAnswer = $this->test->get_answer_result_by_question_id($arrQuestionId);
        $total_question = count($arrAnswer);
        foreach ($arrAnswer as $key => $answer) { 
            $arrAnswerResult[$answer['answer_id']][] = $answer;
        }
        // check result
        $answer_true = 0; $arrAnswerTrue = array();
        foreach ($arrAnswerResult as $key1 => $arrAnswerLists) {
            $userAnswer = $arrUserAnswer[$key1];
            if (!$userAnswer || count($userAnswer) != count($arrAnswerLists)) {
                continue;
            }
            reset($userAnswer);
            foreach ($arrAnswerLists as $key2 => $value) {
                //var_dump($userAnswer[$key2],$value);
                if (strtolower(trim($value['answer'])) == strtolower(trim($userAnswer[$key2]))) {
                    $answer_true ++;
                    $arrAnswerTrue[$key1][$key2] = 1;
                }
            }
        }

        // What id save this ressult !!!!!!!!!!!!!!!!

        /////////////// INSERT LOG ///////////
        $score_converted = $this->test->get_score($answer_true);

        $arr_res = $this->test->getResult_and_Suggest_byPoint($type,$score_converted);
        $score_text = $arr_res[0];
        $score_suggest = $arr_res[1];


        if ($this->input->post('fulltest_timestamp')) {
            $fulltest_timestamp_log =  (int) $this->input->post('fulltest_timestamp');
        }else{
            $fulltest_timestamp_log = 0;
        }
        $test_log_id = $this->test->test_logs_insert(array('test_id' => $test_id, 'timestamp_fulltest'=> $fulltest_timestamp_log,'user_id' => (int) $userData['user_id'], 'test_type' => $type, 'start_time' => $start_time,'end_itme' => time(), 'score' => $score_converted,'score_detail' => array('true' => $answer_true,'arrAnswerTrue' => $arrAnswerTrue),'answer_list' => $arrUserAnswer));

        $spent_time = time() - $start_time;
        $spent_time_format =  sprintf('%02d:%02d', ($spent_time/60%60), $spent_time%60);
        $data = array(
            'arrTestRelate' => $arrTestRelate,
            'test_log_id' => $test_log_id,
            'type' => $type,
            'testDetail' => $testDetail,
            'score_converted' => $score_converted,
            'score_text' => $score_text,
            'score_suggest' => $score_suggest,
            'answer_true' => $answer_true,
            'total_question' => $total_question,
            'spent_time' => $spent_time_format,
            'arrAnswerTrue' => $arrAnswerTrue,
            'arrAnswerResult' => $arrAnswerResult,
            'arrUserAnswer' => $arrUserAnswer,
            'spent_time_percent' => round($spent_time / ($total_time * 60)*100),
            'replay_url' => replace_test_link($testDetail['share_url'],$type) . '?skill=1'
        );

        $this->config->set_item("breadcrumb",array(array('name' => $cateDetail['name'],'link' => $cateDetail['share_url']),array("name" => 'Kết quả test')));

        if ($this->input->post('fulltest_timestamp') ){
            // Full test
            $fulltest_timestamp = $this->input->post('fulltest_timestamp');
            $fulltest_all_step = unserialize($this->input->post('fulltest_all_step'));
            $fulltest_now_step = (int) $this->input->post('fulltest_now_step');

            // Check nếu số lượng step = 1 thì tự động chuyển sang mono test

            // Mặc định:
            $arr_fulltest_all_detail = array(
                'fulltest_timestamp' => $fulltest_timestamp,
                'fulltest_all_step' => serialize($fulltest_all_step),
                'fulltest_now_step' => (int) $fulltest_now_step + 1,
            );

            if ($fulltest_now_step >= ( count($fulltest_all_step)-1 ) ){
                redirect('/test/result_fulltest/'.$fulltest_timestamp,'auto',301);
            }else{
                $arr_fulltest_all_detail['url'] = $fulltest_all_step[$fulltest_now_step + 1];
                return $this->load->view('common/redirect_post',$arr_fulltest_all_detail,false); 
            }
        }
        return $this->load->layout('test/result_listread',$data);
    }

    public function result_fulltest($timestamp_fulltest){
        $this->load->model('test_model','test');
        $this->load->model('category_model','cate');

        $this->load->config("data");
        //////// USSER //////
        $userData = $this->permission->getIdentity();

        // update count hit
        $list_test_logs = $this->test->get_fulltest_by_timestamp($timestamp_fulltest);
        if(!$list_test_logs) {
            show_404();
        }

        $spent_time = 0;
        $score = array();
        $list_logs = array();
        foreach ($list_test_logs as $key => $test_logs) {
            $spent_time += ($test_logs['end_time'] - $test_logs['start_time']);
            if(in_array($test_logs['test_type'], array(1,2))){     //Chỉ tính điểm listening và reading
                $score[] = $test_logs['score'];
            }
            $list_logs[$test_logs['test_type']] = $test_logs;
        }
        $test_id = $test_logs['test_id'];
        //Get test detail
        $testDetail = $this->test->get_test_detail(array('test_id' => $test_id));

        /////////////// INSERT LOG ///////////
        $type = 'fulltest';
        $score_converted = array_sum($score) / count($score);

        $arr_res = $this->test->getResult_and_Suggest_byPoint($type, $score_converted);
        $score_text = $arr_res[0];
        $score_suggest = $arr_res[1];
        $spent_time_format =  sprintf('%02d:%02d', ($spent_time/60%60), $spent_time%60);

        $data = array(
            'test_logs' => $list_logs,
            'type' => $type,
            'score_converted' => $score_converted,
            'score_text' => $score_text,
            'score_suggest' => $score_suggest,
            'spent_time' => $spent_time_format,
            'testDetail' => $testDetail,
            'replay_url' => replace_test_link($testDetail['share_url'],'listening')
        );
        $this->config->set_item("breadcrumb",array(array("name" => 'Kết quả fulltest')));

        //Send mail
        $html = $this->load->view('test/mail/send_request',array('fullname' => strip_tags($userData['fullname'])),TRUE);
        send_mail(strip_tags($userData['email']),'[Aland IELTS] Xác nhận hoàn thành fulltest ',$html);

        return $this->load->layout('test/result_fulltest', $data);
    }

    // Gửi yêu cầu chấm bài
    public function send_request($log_id, $result) {
        $this->load->model('test_model','test');
        $this->load->model('category_model','category');
        $this->load->model('admin/setting_model','setting');
        $this->load->config("data");
        ////// get log detail ////////
        $arrLogDetail = $this->test->get_test_logs_detail($log_id);

        if ($this->input->post()) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );
            if($arrLogDetail['status']){
                echo json_encode(array('status' => 'error', 'error_message' => 'Bạn đã gửi yêu cầu chấm điểm cho bài test này', 'csrf_hash' => $csrf['hash']));
                exit;
            }
            $this->_validation();
            if ($this->form_validation->run()) {
                //Insert thông tin test log
                $params = array(
                    'fullname' => strip_tags($this->input->post('fullname')),
                    'email' => strip_tags($this->input->post('email')),
                    'phone' => strip_tags($this->input->post('phone')),
                    'address' => strip_tags($this->input->post('address')),
                );
                $input['test_logs'] = array(
                    'status' => 1,          //Trạng thái gửi yêu cầu chấm điểm
                    'params' => json_encode($params)
                );
                $this->load->model('test_model', 'test');
                $this->test->test_logs_update($log_id, $input);

                switch ($arrLogDetail['test_type']) {
                    case '3':
                        $test_type_name = 'IELTS Writing';
                        break;
                    case '4':
                        $test_type_name = 'IELTS Speaking';
                        break;
                    default:
                        $test_type_name = '';
                        break;
                }
                $html = $this->load->view('test/mail/send_request',array('fullname' => strip_tags($this->input->post('fullname'))),TRUE);
                send_mail(strip_tags($this->input->post('email')),'[Aland IELTS] Xác nhận yêu cầu chấm điểm '.$test_type_name,$html);

                echo json_encode(array('status' => 'success', 'message' => 'Bạn đã gửi yêu cầu chấm điểm thành công. Kết quả sẽ được gửi qua mail. Các bạn nhớ check mail thường xuyên nhé.', 'csrf_hash' => $csrf['hash']));
                exit;
            }else{
                echo json_encode(array('status' => 'error', 'message' => $this->form_validation->error_array(), 'csrf_hash' => $csrf['hash']));
                exit;
            }
        }

        /////////// CHECK PERMISSION ////////
        $test_id = (int) $arrLogDetail['test_id'];
        $keyType = $arrLogDetail['test_type'];

        $type = $this->config->item('test_type');
        $type = strtolower($type[$keyType]);

        // get detail test 
        $testDetail = $this->test->get_test_detail(array('test_id' => $test_id));
        ///////// get category //////////
        $cateDetail = $this->category->detail($testDetail['original_cate']);

        /* $userData = $this->permission->getIdentity();
        if ($testDetail['test_time'] > 0 && !$userData) {
            return redirect(SITE_URL.'/users/login?redirect_uri='.current_url(),'refresh');
        }*/
        if (empty($testDetail)){
            show_404();
        }

        // if($arrLogDetail['status']){
        //     echo 'Đã gửi yêu cầu chấm bài';
        //     exit;
        // }

        /////// SEO //////
        $this->load->setData('title',$testDetail['title'] .' -' .$type);
        $this->load->setData('meta',array(
            'keyword' => $testDetail['title'],
            'description' => cut_text($testDetail['description'],300)
        ));
        $this->load->setData('ogMeta',array(
                'og:image' => getimglink($testDetail['images']),
                'og:title' => $testDetail['title'],
                'og:description' => $testDetail['description'],
                'og:url' => current_url())
        );

//        $redirect_url = '';

        $redirect_url = $this->setting->get_redirect_link_test($type);

        $data = array(
            'testDetail' => $testDetail,
            'test_log_id' => $test_log_id,
            'type' => $type,
            'total_question' => $total_question,
            'arrQuestion' => $arrQuestion,
            'arrTestRelate' => $arrTestRelate,
            'gramaly' => $gramaly,
            'userAnswer' => $user_answer,
            'profile' => $this->permission->getIdentity(),
            'replay_url' => replace_test_link($testDetail['share_url'],3).'?skill=1',
            'redirect_url' => $redirect_url
        );


        $this->config->set_item("breadcrumb",array(array("name" => 'Gửi yêu cầu chấm bài')));
        return $this->load->layout('test/send_request',$data);
    }

    private function _validation() {
        $this->load->library('form_validation');
        $valid = array(
            array(
                'field' => 'fullname',
                'label' => 'Họ và tên',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ),
            array(
                'field' => 'phone',
                'label' => 'Số diện thoại',
                'rules' => 'required'
            ),
            array(
               'field' => 'address',
               'label' => 'Cơ sở',
               'rules' => 'required'
            ),
        );
        $this->form_validation->set_rules($valid);
    }

    public function sendEmail_from_IMAP($arr_receiver,$email_title, $email_body, $name_sender = "Aland")
    {
        $CI = &get_instance();
        // load library
        $config = array(
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'thanhdat.imap@gmail.com',
            'smtp_pass' => 'cacc842679315',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'protocol' => 'smtp',
            'newline'   =>"\r\n",
        );
        $CI->load->library('email',$config);
        $CI->email->clear();
        $CI->email->from($config['smtp_user'], $name_sender);
        $CI->email->to($arr_receiver);
        $CI->email->subject($email_title);
        $CI->email->message($email_body);
        $CI->email->send(TRUE);
//        var_dump($this->email->print_debugger(array('headers')));
        //echo $CI->email->print_debugger();
        /* if ($CI->email->send(TRUE)) {
            return TRUE;
        } else {
            if (ENVIRONMENT == 'development') {
                $CI->email->print_debugger(array('headers'));
            }
            return FALSE;
        }*/

    }

    public function testEmail(){
        $this->sendEmail_from_IMAP(array('zingfeng.9x@gmail.com'),'Test Email','This is body');
    }

    public function test_speaking_29_7(){
        $test_id = 14;
        $type = 4;

        /////////// CHECK PERMISSION ////////
        $test_id = (int) $test_id;
        $this->load->config("data");
        $keyType = array_search ($type, array_map('strtolower', $this->config->item('test_type')));
        $this->load->model('test_model','test');
        $this->load->model('category_model','category');
        // get detail test
        $testDetail = $this->test->get_test_detail(array('test_id' => $test_id));
        ///////// get category //////////
        $cateDetail = $this->category->detail($testDetail['original_cate']);
        //Check user login
        if(!($user_id = $this->permission->getId())){
            $redirect_uri = current_url();
            if($queryString = $_SERVER['QUERY_STRING']){
                $redirect_uri .= '?'.$queryString;
            }
            $redirect_uri = SITE_URL.'/users/login?redirect_uri='.urlencode($redirect_uri);
            redirect($redirect_uri);
        }

        if (empty($testDetail)){
            show_404();
        }
        ///////// CHECK CLASS ////////
        $arrQuestion = $this->test->get_question_by_test(array('test_id' => $test_id,'type' => $keyType, 'limit' => 200));
        //var_dump($arrQuestion); die;
        if (empty($arrQuestion)){
            show_404();
        }

        foreach ($arrQuestion as $key => $questionDetail) {
            $arrQuestionId[] = $questionDetail['question_id'];
        }

        $arrQuestionGroup = $this->test->get_question_group(array('parent_id' => $arrQuestionId));

        $start_time = time();
        ///////// GET DETAIL
        $data = array('keyType' => $keyType,
            'test' => $testDetail,
            'cateDetail' => $cateDetail,
            'arrQuestion' => $arrQuestion,
            'arrQuestionGroup' => $arrQuestionGroup,
            'start_time' => $start_time,
            'token' => '123'
        );


        /////// Test type ///////
        $arr_list_test_type = array();
        $this->load->config("data");
        $arr_test_type = $this->config->item('test_type');
        foreach ($arr_test_type as $type_id => $type_name) {
            // Check question
            $arrQuestion = $this->test->get_question_by_test(array('test_id' => $test_id, 'type' => $type_id, 'limit' => 200));
            if($arrQuestion){
                $arr_list_test_type[] = $type_name;
            }
        }
        $data['arr_list_test_type'] = $arr_list_test_type;

        //////////////////////////////
        //////////////////////////////
        //////////////////////////////

        if (! $this->input->get('skill')) {

            // Lấy thêm thông tin bài test
            if ($this->input->post('fulltest_timestamp')) {
                // Timestamp Exist
                $fulltest_timestamp = $this->input->post('fulltest_timestamp');
                $fulltest_all_step = unserialize($this->input->post('fulltest_all_step'));
                $fulltest_now_step = (int) $this->input->post('fulltest_now_step');



                // Mặc định:
                $arr_fulltest_all_detail = array(
                    'fulltest_timestamp' => $fulltest_timestamp,
                    'fulltest_all_step' => serialize($fulltest_all_step),
                    'fulltest_now_step' => $fulltest_now_step,
                );
//                var_dump($arr_fulltest_all_detail);exit;

            } else {
//                // generate fulltest timestamp
                $fulltest_all_step = array();
//                var_dump($arr_list_test_type);
                foreach ($arr_list_test_type as $type_fcking) {
                    $fulltest_all_step[] = str_replace('/test/', '/test/' . trim(strtolower($type_fcking)) . '/', $testDetail['share_url']);
                }
//                var_dump($fulltest_all_step); exit();
                $arr_fulltest_all_detail = array(
                    'fulltest_timestamp' => time(),
                    'fulltest_all_step' => serialize($fulltest_all_step),
                    'fulltest_now_step' => 0,
                );
                // Nếu full test có 1 kỹ năng thì chuyển thành mono test
                if (count($fulltest_all_step) == 1){
                    redirect($_SERVER['REQUEST_URI'].'?skill=1','auto',301);
                }

            }
        }
        if (isset($arr_fulltest_all_detail)) $data['arr_fulltest_all_detail'] = $arr_fulltest_all_detail;

        //////////////////////////////
        //////////////////////////////
        //////////////////////////////


        /////// SEO //////
        $this->load->setData('title',$testDetail['title'] .' -' .$type);
        $this->load->setData('meta',array(
            'keyword' => $testDetail['title'],
            'description' => cut_text($testDetail['description'],300)
        ));
        $this->load->setData('ogMeta',array(
                'og:image' => getimglink($testDetail['images']),
                'og:title' => $testDetail['title'],
                'og:description' => $testDetail['description'],
                'og:url' => current_url())
        );
        $this->config->set_item("breadcrumb",array(array('name' => $cateDetail['name'], 'link' => $cateDetail['share_url']),array("name" => $testDetail['title'])));

//        var_dump($type);
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        exit;
//        return $this->load->layout('test/speaking',$data,FALSE,'layout_test'); // cũ
        return $this->load->layout('test/speaking2',$data,FALSE,'layout_test');
    }

}