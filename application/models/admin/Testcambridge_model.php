<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testcambridge_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    public function lists($params = array()){
        $params = array_merge(array('limit' => 30,'offset' => 0),$params);
        if ($params['keyword']){
            $this->db->like('title',$params['keyword']);
        }
        if ($params['cate_id']){
            $this->db->where('original_cate',$params['cate_id']);
        }
        if ($params['user_id']) {
            $this->db->where('user_id',$params['user_id']);
        }
        $this->db->order_by('publish_time DESC, n.test_id DESC');
        $this->db->select('n.test_id,n.share_url,n.title,n.publish_time,n.publish,n.original_cate');
        $query = $this->db->get('cambridge_test as n',$params['limit'],$params['offset']);
        return $query->result_array();
    }
    public function get_list_by_arr_id($arrID){
        $this->db->where_in('test_id',$arrID);
        $this->db->select('test_id,title');
        $query = $this->db->get('cambridge_test');
        return $query->result_array();
    }
    public function detail($id,$params = array()){
        $this->db->where('n.test_id',$id);
        if ($params['user_id']) {
            $this->db->where('n.user_id',$params['user_id']);
        }
        $query = $this->db->get('cambridge_test as n',1);
        return $query->row_array();
    }
    public function insert($input){
        $profile = $this->permission->getIdentity();
        $input['test'] = array_merge($input['test'],array(
            'user_id' => $profile['user_id'],
            'create_time' => time(),
            'update_time' => time(),
        ));
        $this->db->insert('cambridge_test',$input['test']);
        $test_id = (int)$this->db->insert_id();
        if (!$test_id) return false;
        // update share url
        // get original cate
        $orgCateId = $input['test']['original_cate'];
        $cateorg = 'page';
        if ($orgCateId > 0){
            $cateorg = $this->cate_detail($orgCateId);
            $cateorg = set_alias_link($cateorg['name']);
        }
        
        // set share_url
        $this->db->set("share_url",'/testcambridge/'.$cateorg.'/'.set_alias_link($input['test']['title']).'-'.$test_id.'.html');
        $this->db->where("test_id",$test_id);
        $this->db->update('cambridge_test');
        return $test_id;
    }
    public function update($test_id,$input){
        // get original cate
        $cateorg = 'page';
        $orgCateId = $input['test']['original_cate'];
        if ($orgCateId > 0){
            $cateorg = $this->cate_detail($orgCateId);
            $cateorg = set_alias_link($cateorg['name']);
        }
        // set more input
        $input['test'] = array_merge($input['test'], array(
            'update_time' => time(),
            'share_url' => '/testcambridge/'.$cateorg.'/'.set_alias_link($input['test']['title']).'-'.$test_id.'.html'
        ));
        // update test 
        $this->db->where('test_id',$test_id);
        $this->db->update('cambridge_test',$input['test']);
        $countRow = $this->db->affected_rows();        
        // return result
        return $countRow;
    }
    
    /**
    * @author: namtq
    * @todo: Delete test
    * @param: test_id
    */
    public function delete($cid){
        $cid = (is_array($cid)) ? $cid : (int) $cid;
        /** xoa test_to_cat **/
        //$this->db->where_in('test_id',$cid);
        //$this->db->delete('cambridge_test_to_cate');
        /** xoa test_to_tag **/
        //$this->db->where_in('test_id',$cid);
        //$this->db->delete('test_to_tags');

        
        /** xoa image relate **/
        //$this->db->where_in('test_id',$cid);
        //$this->db->delete('test_images');
        /** xoa test **/
        $this->db->where_in('test_id',$cid);
        $this->db->delete('cambridge_test');
        $affected_rows =  $this->db->affected_rows();
        /** xoa question **/
        $this->db->where_in('test_id',$cid);
        $this->db->delete('cambridge_question');
        // check affected row
        return $affected_rows;
    }
    
    /////////////////////QUESTION////////////////////
    public function list_question($params){
        $this->db->where('test_id',$params['test_id']);
        $this->db->order_by("ordering, question_id DESC");
        $query = $this->db->get("cambridge_question");
        return $query->result_array();
    }

    public function question_insert($input){
        $profile = $this->permission->getIdentity();
        $input = array_merge($input,array(
            'user_id' => $profile['user_id'],
            'create_time' => time(),
        ));
        $this->db->insert('cambridge_question',$input);
        $question_id = (int)$this->db->insert_id();
        return $question_id;
    }
    public function question_update($question_id,$input) {
        $this->db->where("question_id",$question_id);
        $this->db->update('cambridge_question',$input);
        return TRUE;
    }
    public function question_detail($question_id) {
        $this->db->where('question_id',$question_id);
        $query = $this->db->get("cambridge_question");
        return $query->row_array();
    }
    /**
    * @author: hoanguyen
    * @todo: Delete question
    */
    public function question_delete($cid = array()){
        /** xoa question **/
        $this->db->where_in('question_id',$cid);
        $this->db->delete('cambridge_question');
        $affected_rows =  $this->db->affected_rows();
        // check affected row
        return $affected_rows;
    }
    public function get_answer_by_question($params = array()) {
        $this->db->where("question_id",$params['question_id']);
        $this->db->order_by("ordering");
        $query = $this->db->get("cambridge_question_answer");
        return $query->result_array();
    }
    public function answer_insert($question_id,$input = array()) {
        $questionDetail = $this->question_detail($question_id);
        // delete old answer
        $this->db->where("question_id",$question_id);
        $this->db->delete('cambridge_question_answer');
        // insert new answer
        foreach($input as $key => $answer){
            if($answer['label']){
                $correct = (int)$answer['correct'];
                $parent = (int) $answer['parent'];
                switch ($questionDetail['type']) {
                    case 1:
                        $parent = 0;
                        break;
                }
                if ($parent == 1) {$correct = 0;}
                $input_answer[] = array(
                    'content' => $answer['label'],
                    'question_id' => $question_id,
                    'correct' => $correct,
                    'parent' => $parent,
                    'ordering' => $key,
                    'object' => $answer['object'],
                    'sound' => $answer['sound_answer'],
                );
            }
        }
        if ($input_answer) {
            $this->db->insert_batch('cambridge_question_answer',$input_answer);
        }
    }
    
    //log test
    public function log_lists($params = array()) {
        if($params['title']){
            $this->db->like('t.title',$params['title']);
        }
        $this->db->select('l.*,t.title,u.fullname');
        $this->db->join('test as t',"t.test_id = l.test_id");
        $this->db->join('users as u','u.user_id = l.user_id');
        $query = $this->db->get('log_test as l',$params['limit'],$params['offset']);
        return $query->result_array();
    }
    public function log_delete($arrId) {
        if (!is_array($arrId)) {
            return false;
        }
        // delete log
        $this->db->where_in("id",$arrId);
        $this->db->delete("log_test");
        return true;
    }

    //////////////////////////////////// CATEGORY /////////////////////////
    public function cate_detail($id){
        $this->db->where('cate_id',$id);
        $query = $this->db->get('cambridge_test_cate',1);
        return $query->row_array();
    }
    /**
    * @author: Namtq
    * @todo: Insert category
    */
    public function cate_insert($input){
        $input = array_merge($input, array(
            'lang' => $this->session->userdata("lang"),
            'create_time' => time(),
            'update_time' => time()
        ));
        // insert data
        $this->db->insert('cambridge_test_cate',$input);
        $cateid = (int)$this->db->insert_id();
        // update share_url
        $this->db->where("cate_id",$cateid);
        $this->db->set("share_url",'/test/'.set_alias_link($input['name']).'-tl'.$cateid.'.html');
        $this->db->update("cambridge_test_cate");
        // return 
        return $cateid;
    }
    public function cate_update($cate_id, $input){
        $input = array_merge($input, array(
            'update_time' => time(),
            'share_url' => '/test/'.trim(set_alias_link($input['name']),'/').'-tl'.$cate_id.'.html'
        ));
       
        $this->db->where('cate_id',$cate_id);
        $this->db->update('cambridge_test_cate',$input);
        $countRow = $this->db->affected_rows();
        // edit menu
        /* if ($countRow) {
            $this->db->where("item_mod","news_cate");
            $this->db->where("item_id",$id);
            $query = $this->db->get("menus");
            $row = $query->result_array();
            foreach ($row as $row){
                $this->db->set("link",$input['share_url']);
                $this->db->where("menu_id",$row['menu_id']);
                $this->db->update("menus");
            }
        }*/
        return $countRow;
    }
    /**
    * @author: namtq
    * @todo: Delete category
    */
    public function cate_delete($cid = array()){
        if (is_numeric($cid)) {$cid = array($cid);}
        $arrCate = $this->get_category();
        $arrId = $cid;
        foreach ($cid as $key => $id) {
            if ($id <= 0) continue;
            if ($arrCateRev = $this->recursiveCate($arrCate,array('parent_id' => $id))){
                foreach ($arrCateRev as $key => $c) {
                    $arrId[] = (int) $c['cate_id'];
                }
            }   
            
        }
        $countRow = false;
        if ($arrId) {
            $arrId = array_unique($arrId);
            // Delete news_to_cate
            /* $this->db->where_in('cate_id',$arrId);
            $this->db->delete('news_to_cate'); */
            // DELETE CATEGORY
            $this->db->where_in('cate_id',$arrId);
            $this->db->delete('cambridge_test_cate');
            $countRow = $this->db->affected_rows();
        }
        return $countRow;
    }
    /**
    * @author: namtq
    * @todo: Get category for dropbox
    */
    public function get_category($params = array()) {
        $this->db->select("cate_id, name, share_url, parent, type, ordering");
        $this->db->where("lang",$this->session->userdata("lang"));
        if (isset($params['type']) && $params['type']){
            $this->db->where('type',(int) $params['type']);
        }
        $this->db->order_by('parent,ordering');
        $query = $this->db->get('cambridge_test_cate');
        return $query->result_array();
    }
    /**
    * @author: namtq
    * @todo: Get category for dropbox
    */
    public function recursiveCate($arrCate,$params = array()) {
        $result = array();
        $params = array_merge(array('parent_id' => 0, 'subStr' => '','excluse' => 0),$params);
        foreach($arrCate as $key => $cate){
            if ($cate['cate_id'] == $params['excluse']){
                unset($arrCate[$key]);
                continue;
            }
            if ($cate['parent'] == $params['parent_id']){
                unset($arrCate[$key]);
                $cate['name'] = $params['subStr'].$cate['name'];
                $result[$cate['cate_id']] = $cate;
                $rev = $this->recursiveCate($arrCate,array('parent_id' => $cate['cate_id'], 'excluse' => $params['excluse'], 'subStr' => '-- '.$params['subStr']));
                if ($rev) {
                    $result = $result + $rev;
                }
            }
        }
        return $result;
    }
}