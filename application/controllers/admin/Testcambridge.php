<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testcambridge extends CI_Controller{
    public $module = 'test';
    function __construct(){
        parent::__construct();
        $this->load->setData('title','Danh sách bài test');

    }
    public function index(){
        if ($this->input->post('delete'))
        {
            return $this->_action('delete');
        }
        $this->load->setArray(array("isLists" => 1));
        $data = $this->_index();
        // render view
        $this->load->layout('cambridgetest/index',$data);
    }
    public function add(){
        // load model
        if ($this->input->post('submit')){
            return $this->_action('add');
        }
        $this->load->setArray(array("isForm" => 1));
        // get data
        $data = $this->_add();
        $this->load->layout('cambridgetest/form',$data);
    }
    public function edit($id = 0){
        $id = (int) $id;
        if ($this->input->post('submit')){
            return $this->_action('edit',array('id' => $id));
        }
        $this->load->setArray(array("isForm" => 1));
        $data = $this->_edit($id);
        if (!$data) {
            show_404();
        }
        $this->load->layout('cambridgetest/form',$data);
    }
    private function _index(){
        $limit = $this->config->item("limit_item");
        $this->load->model('admin/testcambridge_model','test');
        // get level of user 
        $page = (int) $this->input->get('page');
        $offset = ($page > 1) ? ($page - 1) * $limit : 0;
        $params = array('limit' => $limit + 1,'offset' => $offset);
        $userLevel = $this->permission->get_level_user();
        if ($userLevel == 1) {
            $params['user_id'] = $this->permission->get_user_id();
        }
        ////////////////// FITER /////////
        $params_filter = array_filter(array(
            'keyword' => $this->input->get('title'),
            'cate_id' => $this->input->get('cate_id'),
        ),'filter_item');
        $params = array_merge($params,$params_filter);
        // get data
        $rows = $this->test->lists($params);
        /** PAGING **/
        $config['total_rows'] = count($rows);
        $config['per_page'] = $limit;
        $this->load->library('paging',$config);
        $paging = $this->paging->create_links();
        unset($rows[$limit]);
        // arrCate
        $arrCate = $this->test->get_category();
        $arrCate = $this->test->recursiveCate($arrCate);
        // set limit
        $this->load->setArray(array("isLists" => 1));
        // set data
        return array('rows' => $rows, 'paging' => $paging, 'arrCate' => $arrCate,'filter' => $params_filter);
    }
    private function _add() {
        $this->load->model('admin/testcambridge_model','test');
        // get category recursive
        $arrCate = $this->test->get_category();
        $arrCate = $this->test->recursiveCate($arrCate);
        return array(
            'arrCate' => $arrCate,
            'row' => array()
        );
    }
    private function _edit($id) {
        $this->load->model('admin/testcambridge_model','test');
        // row detail
        $userLevel = $this->permission->get_level_user();
        if ($userLevel == 1) {
            $params['user_id'] = $this->permission->get_user_id();
        }

        $row = $this->test->detail($id,$params);
        if (!$row) {
            return array();
        }
        // get category recursive
        $arrCate = $this->test->get_category();
        $arrCate = $this->test->recursiveCate($arrCate);

        return  array(
            'arrCate' => $arrCate,
            'row' => $row
        );
    }
    ////////////////////////////////// CATEGORY /////////////////////////////////
    public function cate_index(){
        if ($this->input->post('delete'))
        {
            return $this->_action('cate_delete');
        }
        $this->load->setArray(array("isLists" => 1));
        $data = $this->_cate_index();
        // render view
        $this->load->layout('cambridgetest/cate_list',$data);
    }
    public function cate_add(){
        if ($this->input->post('submit')) {
            return $this->_action('cate_add');
        }
        $this->load->setArray(array("isForm" => 1));
        $data = $this->_cate_add();
        $this->load->layout('cambridgetest/cate_form',$data);
    }
    
    public function cate_edit($id) {
        $id = (int) $id;
        if ($this->input->post('submit')) {
            return $this->_action('cate_edit',array('id' => $id));
        }
        $this->load->setArray(array("isForm" => 1));
        $data = $this->_cate_edit($id);
        $this->load->layout('cambridgetest/cate_form',$data);
    }
    public function _cate_index(){
        $this->load->model('admin/testcambridge_model','test');
        $params = array();
        if ($type = (int) $this->input->get('type')){
            $params['type'] = $type;
        } 
        // get array cate
        $arrCate = $this->test->get_category($params);
        $rows = $this->test->recursiveCate($arrCate);
        // get config data
        $this->load->config('data');
        // set data
        return array('rows' => $rows);
    }
    public function _cate_add(){
        
        $this->load->model('admin/testcambridge_model','test');
        // get category recursive
        $arrCate = $this->test->get_category();
        $arrCate = $this->test->recursiveCate($arrCate);
        // set data to view
        return array(
            'arrCate' => $arrCate,
        );
    }
    public function _cate_edit($id){
        $this->load->model('admin/testcambridge_model','test');
        $row = $this->test->cate_detail(intval($id));
        if (!$row) {
            show_404();
        }
        // get category recursive
        $arrCate = $this->test->get_category();
        $arrCate = $this->test->recursiveCate($arrCate,array('excluse' => $id));
        // set data to view
        return  array(
            'arrCate' => $arrCate,
            'row' => $row
        );
    }
    /////////////////////////////////////// QUESTION /////////////////////////////
    public function question_index($test_id){
        $test_id = (int)$test_id;
        if(!$test_id){
            show_404();
        }   
        $this->load->model('admin/testcambridge_model','test');
        $row = $this->test->detail($test_id);
        if(!$row){
            show_404();
        }
        if ($this->input->post('delete'))
        {
            return $this->_action('delete_question',array('test_id' => $test_id));
        }
        $this->load->setArray(array("isLists" => 1));
        $data = $this->_question_index($test_id);
        $data['test_detail'] = $row;
        // render view
        $this->load->layout('cambridgetest/question_index',$data);
    }

    public function _question_index($test_id){
        $this->load->model('admin/testcambridge_model','test');
        $arrQuestion = $this->test->list_question(array('test_id' => $test_id));
        // get config data
        $this->load->config('data');
        // set data
        return array('rows' => $arrQuestion);
    }

    public function question_add(){
        $test_id = (int)$this->input->get('testid');
        $type = (int)$this->input->get('type');
        if(!$test_id){
            show_404();
        }   
        $this->load->model('admin/testcambridge_model','test');
        $row = $this->test->detail($test_id);
        if(!$row){
            show_404();
        }
        if ($type <= 0) {
            return $this->load->layout('cambridgetest/question_choose');
        }
        // load model
        if ($this->input->post('submit')){
            return $this->_action('question_add',array('test_id' => $test_id,'type' => $type));
        }       
        $this->load->setArray(array("isForm" => 1));
        // get data
        $data = $this->_question_add($test_id);
        $data['test_detail'] = $row;
        $data['type'] = $type;
        $this->load->layout('cambridgetest/question_form',$data);

    }
    public function _question_add(){
        return array();
    }

    public function question_edit($question_id){
        $question_id = (int)$question_id;
        if(!$question_id){
            show_404();
        }   
        // load model
        if ($this->input->post('submit')){
            return $this->_action('question_edit',array('question_id' => $question_id));
        }   
        $this->load->setArray(array("isForm" => 1));
        // get data
        $data = $this->_question_edit($question_id);
        //var_dump($data);die;
        $this->load->layout('cambridgetest/question_form',$data);
    }
    public function _question_edit($question_id){
        $this->load->model('admin/testcambridge_model','test');
        $row = $this->test->question_detail($question_id);
        if(!$row){
            show_404();
        }
        $answer = $this->test->get_answer_by_question(array('question_id' => $question_id));
        return array('row' => $row,'answer' => $answer,'type' => $row['type']);
    }

    /////////////////////////LOG TEST////////////////////////////
    public function log_lists(){
        if ($this->input->post('delete'))
        {
            return $this->_action('log_delete');
        }
        $this->load->setArray(array("isLists" => 1));
        $data = $this->_log_lists();
        // render view
        $this->load->layout('cambridgetest/log_lists',$data);
    }
    private function _log_lists(){
        $limit = $this->config->item("limit_item");
        $this->load->model('admin/testcambridge_model','test');
        // get level of user 
        $page = (int) $this->input->get('page');
        $offset = ($page > 1) ? ($page - 1) * $limit : 0;
        $params = array('limit' => $limit + 1,'offset' => $offset);
        ////////////////// FITER /////////
        $params_filter = array_filter(array(
            'title' => $this->input->get('title'),
            'email' => $this->input->get('email'),
        ),'filter_item');
        $params = array_merge($params,$params_filter);
        // get data
        $rows = $this->test->log_lists($params);

        /** PAGING **/
        $config['total_rows'] = count($rows);
        $config['per_page'] = $limit;
        $this->load->library('paging',$config);
        $paging = $this->paging->create_links();
        unset($rows[$limit]);
        // set limit
        $this->load->setArray(array("isLists" => 1));
        // set data
        return array('rows' => $rows, 'paging' => $paging,'filter' => $params_filter);
    }

    public function _action($action, $params = array()) {
        $this->load->model('admin/testcambridge_model','test');
        $this->load->model('admin/logs_model','logs');
        switch ($action) {
            case 'add':
            case 'edit':
                $this->load->library('form_validation');
                $valid = array(
                    array(
                         'field'   => 'title',
                         'label'   => 'Tên bài test',
                         'rules'   => 'required'
                    ),
                    array(
                        'field'   => 'original_cate',
                        'label'   => 'Nhóm',
                        'rules'   => 'is_natural_no_zero'
                    )
                );
                $this->form_validation->set_rules($valid);
                if ($this->form_validation->run() == true)
                {
                    $input['test'] = array(
                        'title' => $this->input->post('title'),
                        'publish' => intval($this->input->post('publish')),
                        'test_time' => intval($this->input->post('test_time')),
                        'original_cate' => intval($this->input->post("original_cate")),
                        'publish_time' => (int) convert_datetime($this->input->post('publish_time')),
                        'description' => $this->input->post('description'),
                        'images' => $this->input->post('images'),
                        'video_id' => intval($this->input->post('video_id')),
                    );
                    if (!$this->permission->check_permission_backend('publish')) {
                        unset($input['test']['publish']);
                    }
                    if ($action == 'add') {
                        $result = $this->test->insert($input);
                        if ($item_id = $result) {
                            $html =$this->load->view('cambridgetest/form',$this->_add()); 
                        }
                    }
                    else {
                        if ($this->security->verify_token_post($params['id'],$this->input->post('token'))) {
                            $result = $this->test->update($params['id'],$input);    
                        }
                        if ($result) {
                            $item_id = $params['id'];
                            $html =$this->load->view('cambridgetest/form',$this->_edit($params['id'])); 
                        }
                    }
                    if ($result) {
                        // log action
                        $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $item_id));
                        // return result
                        return $this->output->set_output(json_encode(array('status' => 'success', 'html' => $html, 'result' => $result, 'message' => $this->lang->line("common_update_success"))));
                    }
                }
                else{
                    return $this->output->set_output(json_encode(array('status' => 'error','valid_rule' => $this->form_validation->error_array(), 'message' => $this->lang->line("common_update_validator_error"))));
                }
            break;
            case 'delete':
                $arrId = $this->input->post('cid');
                $arrId = (is_array($arrId)) ? array_map('intval', $arrId) : (int) $arrId;
                if (!$arrId) {
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_delete_min_select"))));
                }
                if (!$this->permission->check_permission_backend('delete')){
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_access_denied"))));
                }
                $result = $this->test->delete($arrId);
                
                if ($result) {
                    // log action
                    $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $arrId));
                    // return result
                    $html = $this->load->view('cambridgetest/list',$this->_index()); 
                    return $this->output->set_output(json_encode(array('status' => 'success','html' => $html, 'result' => $result, 'message' => $this->lang->line("common_delete_success"))));
                }
            break;

            case 'delete_question':
                $arrId = $this->input->post('cid');
                $arrId = (is_array($arrId)) ? array_map('intval', $arrId) : (int) $arrId;
                if (!$arrId) {
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_delete_min_select"))));
                }
                if (!$this->permission->check_permission_backend('delete')){
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_access_denied"))));
                }
                $result = $this->test->delete_question($arrId);

                if ($result) {
                    // log action
                    $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $arrId));
                    // return result
                    $html = $this->load->view('cambridgetest/list',$this->_index());
                    return $this->output->set_output(json_encode(array('status' => 'success','html' => $html, 'result' => $result, 'message' => $this->lang->line("common_delete_success"))));
                }
                break;

            case 'cate_add':
            case 'cate_edit':
                $this->load->library('form_validation');
                $valid = array(
                    array(
                         'field'   => 'name',
                         'label'   => 'Tên nhóm',
                         'rules'   => 'required'
                      ),
                   array(
                         'field'   => 'ordering',
                         'label'   => 'Thứ tự',
                         'rules'   => 'required|integer'
                      ),
                );
                $this->form_validation->set_rules($valid);
                if ($this->form_validation->run() == true)
                {
                    $input = array(
                        'name' => $this->input->post('name'),
                        'ordering' => (int) $this->input->post('ordering'),
                        'parent' => (int) $this->input->post('parent'),
                        'description' => $this->input->post("description"),
                        'images' => $this->input->post("images"),
                        'type' => (int) $this->input->post('type'),
                        'seo_title' => $this->input->post("seo_title"),
                        'seo_keyword' => $this->input->post("seo_keyword"),
                        'seo_description' => $this->input->post("seo_description"),
                    );
                    if ($action == 'cate_add') {
                        $result = $this->test->cate_insert($input);
                        if ($item_id = $result) {
                            $html =$this->load->view('cambridgetest/cate_form',$this->_cate_add()); 
                        }
                    }
                    else {
                        if ($this->security->verify_token_post($params['id'],$this->input->post('token'))) {
                            $result = $this->test->cate_update($params['id'],$input);   
                        }
                        if ($result) {
                            $item_id = $params['id'];
                            $html =$this->load->view('cambridgetest/cate_form',$this->_cate_edit($params['id'])); 
                        }
                    }
                    if ($result) {
                        // log action
                        $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $item_id));
                        // return result
                        return $this->output->set_output(json_encode(array('status' => 'success', 'html' => $html, 'result' => $result, 'message' => $this->lang->line("common_update_success"))));
                    }
                }
                else{
                    return $this->output->set_output(json_encode(array('status' => 'error','valid_rule' => $this->form_validation->error_array(), 'message' => $this->lang->line("common_update_validator_error"))));
                }
            break;
            case 'cate_delete':
                $arrId = $this->input->post('cid');
                $arrId = (is_array($arrId)) ? array_map('intval', $arrId) : (int) $arrId;
                if (!$arrId) {
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_delete_min_select"))));
                }
                if (!$this->permission->check_permission_backend('cate_delete')){
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_access_denied"))));
                }
                $result = $this->test->cate_delete($arrId);
                
                if ($result) {
                    // log action
                    $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $arrId));
                    // return result
                    $html = $this->load->view('cambridgetest/cate_list',$this->_cate_index()); 
                    return $this->output->set_output(json_encode(array('status' => 'success','html' => $html, 'result' => $result, 'message' => $this->lang->line("common_delete_success"))));
                }
            break;
            case 'question_add':
            case 'question_edit':
                $this->load->library('form_validation');
                $valid = array(
                    array(
                         'field'   => 'title',
                         'label'   => 'Tên câu hỏi',
                         'rules'   => 'required'
                    ),
                );
                $this->form_validation->set_rules($valid);
                if ($this->form_validation->run() == true)
                {
                    $input = array(
                        'title' => $this->input->post('title'),
                        'publish' => intval($this->input->post('publish')),
                        'detail' => $this->input->post('detail'),
                        'images' => $this->input->post('images'),
                        'sound' => $this->input->post('sound'),
                    );                  
                    if ($action == 'question_add') {
                        $input['test_id'] = (int)$params['test_id'];
                        $input['type'] = (int)$params['type'];
                        $result = $this->test->question_insert($input);
                        if($result){
                            //insert answer
                            $answer = $this->input->post('answer');
                            $this->test->answer_insert($result,$answer);
                            $item_id = $result;
                            $redirect = SITE_URL.'/testcambridge/question_index/'.$input['test_id'];
                        }
                    }
                    else {
                        if ($this->security->verify_token_post($params['question_id'],$this->input->post('token'))) {
                            $result = $this->test->question_update($params['question_id'],$input);
                            //insert answer
                            $answer = $this->input->post('answer');
                            $this->test->answer_insert($params['question_id'],$answer);
                        }
                        if($result){
                            $item_id = $params['question_id'];
                            $html =$this->load->view('cambridgetest/question_form',$this->_question_edit($params['question_id'])); 
                        }
                    }
                    if ($result) {
                        // log action
                        $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $item_id));
                        // return result
                        return $this->output->set_output(json_encode(array('status' => 'success', 'html' => $html, 'redirect' => $redirect,'result' => $result, 'message' => $this->lang->line("common_update_success"))));
                    }
                }
                else{
                    return $this->output->set_output(json_encode(array('status' => 'error','valid_rule' => $this->form_validation->error_array(), 'message' => $this->lang->line("common_update_validator_error"))));
                }
            break;
            case 'question_delete':
                $arrId = $this->input->post('cid');
                $arrId = (is_array($arrId)) ? array_map('intval', $arrId) : (int) $arrId;
                if (!$arrId) {
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_delete_min_select"))));
                }
                if (!$this->permission->check_permission_backend('question_delete')){
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_access_denied"))));
                }
                $result = $this->test->question_delete($arrId);
                
                if ($result) {
                    // log action
                    $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $arrId));
                    // return result
                    $html = $this->load->view('testcambridge/question_index', $this->_question_index($params['test_id'])); 
                    return $this->output->set_output(json_encode(array('status' => 'success','html' => $html, 'result' => $result, 'message' => $this->lang->line("common_delete_success"))));
                }
                break;
            case 'log_delete':
                $arrId = $this->input->post('cid');
                $arrId = (is_array($arrId)) ? array_map('intval', $arrId) : (int) $arrId;
                if (!$arrId) {
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_delete_min_select"))));
                }
                if (!$this->permission->check_permission_backend('delete')){
                    return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_access_denied"))));
                }
                $result = $this->test->log_delete($arrId);
                
                if ($result) {
                    // log action
                    $this->logs->insertAction(array('action' => $action,'module' => $this->module, 'item_id' => $arrId));
                    // return result
                    $html = $this->load->view('cambridgetest/log_lists',$this->_log_lists()); 
                    return $this->output->set_output(json_encode(array('status' => 'success','html' => $html, 'result' => $result, 'message' => $this->lang->line("common_delete_success"))));
                }
            break;
            default:
                # code...
                break;
        }   
        return $this->output->set_output(json_encode(array('status' => 'error', 'message' => $this->lang->line("common_no_row_update"))));
    }

    public function suggest_test(){
        $keyword = $this->input->get("term");
        $page = (int) $this->input->get('page');
        $page = ($page > 1) ? $page : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $this->load->model('admin/testcambridge_model','test');
        $params = array('limit' => $limit + 1,'keyword' => $keyword,'offset' => $offset);
        $arrTest = $this->test->lists($params);
        $data = $option = array();
        if (count($arrTest) > $limit) {
            $option['nextpage'] = true;
            unset($arrTest[$limit]);
        }
        foreach ($arrTest as $key => $test) {
            $data[] = array('id' => $test['test_id'], 'text' => $test['title'],'item_id' => $test['test_id']);
        }
        return $this->output->set_output(json_encode(array('status' => 'success','data' => $data,'option' => $option)));
    }

    public function question_sort(){
        $test_id = $this->input->post('test_id');
        $arrQuestionId = $this->input->post('question_id');
        if (!$test_id || !$arrQuestionId) {
            return $this->output->set_output(json_encode(array('status' => 'error', 'message' => 'Thứ tự không thay đổi')));
        }
        // get question by test_id
        $this->load->model('admin/testcambridge_model','test');
        $arrQuestion = $this->test->list_question(array('test_id' => $test_id));
        
        foreach ($arrQuestion as $row) {
            $order = array_search($row['question_id'] , $arrQuestionId);
            if (is_numeric($order)) {
                $this->db->where('question_id',$row['question_id']);
                $this->db->set('ordering',$order);
                $this->db->update('cambridge_question');
            }
        }
        return $this->output->set_output(json_encode(array('status' => 'success', 'message' => 'Đã cập nhật thông tin')));
    }
}