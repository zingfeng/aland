<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller
{
    public function getComment()
    {
        $this->load->model('Comment_model','comment');
        $this->load->model('Users_model','users');

        $profile = $this->permission->getIdentity();
        $user_id = $profile['user_id'];
        $info_user = $this->users->getUserById($user_id);

        $data_content = json_decode($_REQUEST['data'],true);
        $type = (int) $data_content['type'];
        $target_id = (int) $data_content['target_id'];
        $list_comment_lv1 = $this->comment->get_list_cmt_lv1($user_id,$type, $target_id, 10, true);
        $number_comment = $this->comment->get_number_cmt($type, $target_id);

        $number_cmt_get = count($list_comment_lv1);


        $list = array();
        for ($i = 0; $i < count($list_comment_lv1); $i++) {
            $mono_comment = $list_comment_lv1[$i];
            $parent_id = (int)$mono_comment['comment_id'];
            $list_comment_lv2 = $this->comment->get_list_cmt_lv2($user_id,$type, $target_id, $parent_id);
            $number_cmt_get += count($list_comment_lv2);
            $mono_comment['lv2'] = $list_comment_lv2;
            array_push($list,$mono_comment);
        }

        $number_cmt_info = $number_cmt_get.'/'.$number_comment;

        $this->db->where('user_id',$user_id);
        $this->db->select('fullname');
        $query = $this->db->get('users');
        $arr_res = $query->result_array();
        $username = $arr_res[0]['fullname'];
        $my_avatar = $info_user['avatar'];
        $my_char_avar = strtoupper(mb_substr($username,0,1, "utf-8"));


        $this->load->helper('text');


        $data = array(
            'info' => $number_cmt_info,
            'list' => $list,
            'my_char_avar' => $my_char_avar,
            'my_avatar' => $my_avatar,
            'my_username' => $username,
            'my_userid' => $user_id,
            'target_id' => $target_id,
            'type' => $type,
        );

        $this->load->view('block/comment',$data,false);
    }

    public function insertComment(){
        $this->load->model('Comment_model','comment');
        $profile = $this->permission->getIdentity();
        if ($profile){
            $user_id = strip_tags($profile['user_id']);
            $content = strip_tags($_REQUEST['content']);
            $type = (int) strip_tags($_REQUEST['type']);
            $target_id = (int) strip_tags($_REQUEST['target_id']);
            $parent_id = (int) strip_tags($_REQUEST['parent_id']);
            $insertcomment_id = $this->comment->add_comment($user_id, $type, $target_id, $content, $parent_id, 1);
        }
        echo $insertcomment_id;
    }

    public function getMoreComment()
    {

    }

    public function actionLike(){
        $this->load->model('Comment_model','comment');
        $profile = $this->permission->getIdentity();
        if ($profile){
            $user_id = $profile['user_id'];
            $status =  $_REQUEST['status'];
            $comment_id = (int) $_REQUEST['comment_id'];
            if ($status == 0){
                $this->comment->like_comment($user_id, $comment_id);
                echo 'like'.$comment_id;
            }else{
                $this->comment->unlike_comment($user_id, $comment_id);
                echo 'unlike'.$comment_id;

            }
        }
    }

    public function delComment(){
        var_dump($_REQUEST);
        $this->load->model('Comment_model','comment');
        $profile = $this->permission->getIdentity();
        if ($profile){
            $user_id = $profile['user_id'];
            $comment_id = $_REQUEST['comment_id'];
            $res = $this->comment->del_comment($user_id, $comment_id);
            echo 'del'.$comment_id;
            var_dump($res);
        }else{
            echo 'Đăng nhập đi cưng :)) ';
        }
    }

    public function test(){
        $string = ' var_dump($_REQUEST);
        $this->load->model(\'Comment_model\',\'comment\');
        $profile = $this->permission->getIdentity();
        if ($profile){
            $user_id = $profile[\'user_id\'];
            $comment_id = $_REQUEST[\'comment_id\'];
            $res = $this->comment->del_comment($user_id, $comment_id);
            echo \'del\'.$comment_id;
            var_dump($res);
        }else{
            echo \'Đăng nhập đi cưng :)) \';
        }';
//        echo $string;
        $this->load->helper('text');
        $string2 = highlight_code($string);
        var_dump( $string2);


    }

}
