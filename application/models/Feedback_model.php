<?php
/**
 * Created by PhpStorm.
 * User: Zingfeng-Dragon
 * Date: 29/7/2018
 * Time: 11:27 PM
 */

class Feedback_model extends CI_Model
{
    // INFO chung

    public function get_all_info_system(){
        // count class,teacher , feedback,
        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();
        $count_class = count($arr_res);

        $this->db->select('*');
        $query = $this->db->get('feedback_teacher');
        $arr_res = $query->result_array();
        $count_teacher = count($arr_res);

        $this->db->select('*');
        $query = $this->db->get('feedback_paper');
        $arr_res = $query->result_array();
        $count_paper = count($arr_res);

        return array(
            'count_class' => $count_class,
            'count_teacher' => $count_teacher,
            'count_paper' => $count_paper,
        );

    }

    public function get_all_info_system_by_type($type){
        // count class,teacher , feedback,
        $this->db->select('*');
        $this->db->where('type',$type);
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();
        $count_class = count($arr_res);

        $this->db->select('*');
        $this->db->where('type',$type);
        $query = $this->db->get('feedback_paper');
        $arr_res = $query->result_array();
        $count_paper = count($arr_res);

        $this->db->select('*');
        $this->db->where($type,1);
        $query = $this->db->get('feedback_teacher');
        $arr_res = $query->result_array();
        $count_teacher = count($arr_res);

        return array(
            'count_class' => $count_class,
            'count_teacher' => $count_teacher,
            'count_paper' => $count_paper,
        );

    }

    public function get_list_class_code($type = '')
    {
        if ($type != '') {
            $this->db->where('type', $type);
        }

        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();
        return $arr_res;
    }

    public function get_list_class_code_opening($type = '')
    {
        if ($type != '') {
            $this->db->where('type', $type);
        }

        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();

        $arr_res_living = array();
        for ($i = 0; $i < count($arr_res); $i++) {
            $class_code = $arr_res[$i]['class_code'];
            $openning_T_F = $this->check_class_code_exist($class_code);
            if ($openning_T_F){
                array_push($arr_res_living,$arr_res[$i]);
            }
        }

        return $arr_res_living;
    }

    public function get_list_class_info($type = '')
    {
        if ($type != '') {
            $this->db->where('type', $type);
        }
        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();
        return $arr_res;
    }

    public function get_list_class_id($type = '')
    {

    }


    public function insert_teacher($info){
        $plus = array(
            'time_creat' => time(),
        );
        $data = array_merge($info, $plus);
        $this->db->insert('feedback_teacher', $data);
    }

    public function update_teacher($info){
//        var_dump($info);
        $this->db->where('teacher_id',$info['teacher_id']);
        $this->db->replace('feedback_teacher', $info);
    }

    public function del_teacher($info){
        echo 'model del';
        $this->db->delete('feedback_teacher', array('teacher_id' => $info['teacher_id']));
    }

    public function insert_class($info){
        $this->db->insert('feedback_class', $info);
    }

    public function update_class($info){
//        var_dump($info);
        $this->db->where('class_id',$info['class_id']);
        $this->db->replace('feedback_class', $info);
    }

    public function del_class($info){
        $this->db->delete('feedback_class', array('class_id' => $info['class_id']));
    }



    public function get_info_teacher($teacher_id)
    {
        $this->db->where('teacher_id', $teacher_id);
        $this->db->select('*');
        $query = $this->db->get('feedback_teacher');
        $arr_res = $query->result_array();
        return $arr_res[0];
    }

    public function get_list_info_teacher(){
        $this->db->select('*');
        $query = $this->db->get('feedback_teacher');
        $arr_res = $query->result_array();
        return $arr_res;
    }

    public function get_info_class_by_id_class($id_class)
    {
        $this->db->where('class_id', $id_class);
        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();

        $mono_info = $arr_res[0];
        if (isset($mono_info['list_teacher'])) {
            $arr_techer_id = json_decode($mono_info['list_teacher'], true);
            $arr_techer_info = array();
            for ($i = 0; $i < count($arr_techer_id); $i++) {
                $info_teacher = $this->get_info_teacher($arr_techer_id[$i]);
                array_push($arr_techer_info, $info_teacher);
            }
            $arr_res[0]['list_teacher_info'] = $arr_techer_info;
        }
        // number_feedback

        $arr_res[0]['number_feedback'] = $this->get_number_feedback_by_class_code($mono_info['class_code']);
        return $arr_res[0];
    }

    public function get_number_feedback_by_class_code($class_code){
        $this->db->where('class_code',$class_code);
        $this->db->select('*');
        $query = $this->db->get('feedback_paper');
        $arr_res = $query->result_array();
        return count($arr_res);
    }

    public function get_info_class_by_class_code($class_code)
    {
        $this->db->where('class_code', $class_code);
        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();
        return $arr_res[0];
    }

    public function check_class_code_exist($class_code, $type = '')
    {
        if ($type !== ""){
            $this->db->where('type',$type);
        }
        $class_code = trim(mb_strtolower($class_code));

//        $this->db->where('class_code',$class_code);
        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();
        foreach ($arr_res as $mono){
            $class_code_target = trim(mb_strtolower( $mono['class_code'] ));
            if ($class_code_target === $class_code){
                return true;
            }
        }
        return false;

    }

    public function check_class_feedback_openning($class_code)
    {
        $class_code = mb_strtolower($class_code);
        $this->db->where('class_code', $class_code);
        $this->db->select('*');
        $query = $this->db->get('feedback_class');
        $arr_res = $query->result_array();
        if (count($arr_res) == 0) {
            echo 'Wrong class code !';
            return false;
        }
        if (count($arr_res) > 1) {
            echo 'Class code duplicate !';
            return false;
        }
        $now_time = time();
        $time_start = $arr_res[0]['time_start'];
        $time_end = $arr_res[0]['time_end'];
        if ($time_start != 0) {
            if ($now_time < $time_start) {
                echo 'Lớp ' . $class_code . ' hiện tại chưa nhận feedback !';
                return false;
            }
        }
        if ($time_end != 0) {
            if ($now_time > $time_end) {
                echo 'Lớp ' . $class_code . ' đã quá hạn nhận feedback !';
                return false;
            }
        }
        return true;

    }

    // ====================== PAPER

    public function get_top_class_feedback_newest($number_take,$type = ''){
        $list_feedback_newest = $this->get_list_feedback_paper('',$type,'time_end');

        $class_arr = array(); // json_encode([type,class_code])

        for ($i = 0; $i < count($list_feedback_newest); $i++) {
            if ( count($class_arr) < $number_take ){
                $mono = $list_feedback_newest[$i];
                $type = $mono['type'];
                $class_code = $mono['class_code'];
                $mono_json = json_encode(array($type,$class_code));
                if (!in_array($mono_json,$class_arr)){
                    array_push($class_arr,$mono_json);
                }
            }else{
                break;
            }
        }
        return $class_arr;
    }

    public function insert_feedback_paper($info)
    {
        $this->load->library('user_agent');

        $plus = array(
            'time_end' => time(),
            'ip' => $this->input->ip_address(),
            'browser' => $this->agent->browser() . ' ' . $this->agent->version()
        );
        $data = array_merge($info, $plus);
        $this->db->insert('feedback_paper', $data);
    }

    public function get_list_feedback_paper($class_code = '', $type = '',$order='')
    {
        if ($class_code != ''){
            $this->db->where('class_code',$class_code);
        }
        if ($type != ''){
            $this->db->where('type',$type);
        }

        if( $order != ''){
            $this->db->order_by($order,'DESC');
        }

        $query = $this->db->get('feedback_paper');
        $arr_res = $query->result_array();
        return $arr_res;
    }

    public function get_data_statistic_class($class_code){
        $data = $this -> get_list_feedback_paper($class_code);
        $arr_name = array();
        $arr_time_length = array();

        $arr_data_question_total = array();
        $arr_info_question = array();

        $data_question_list = array();

        foreach ($data as $mono){
            $time_start = $mono['time_start'];
            $time_end = $mono['time_end'];

            $timelength = $time_end - $time_start;
            $arr_time_length[] = $timelength;

            $name_feeder = $mono['name_feeder'];
            $arr_name[] = $name_feeder;

            $detail = json_decode($mono['detail'],true);
//            echo '<pre>';print_r($detail); echo '</pre>';
            foreach ($detail as $mono_detail) {
                $id_quest = $mono_detail[0];
                $type = $mono_detail[1];
                $content = $mono_detail[2];
                $value = (string) $mono_detail[3];
                if (! isset($arr_info_question[$id_quest])){
                    $arr_info_question[$id_quest] = array(
                      'type' =>   $type,
                      'title' =>   $content,
                    );
                }

                switch ($type){
                    case 'ruler':
                        if (! isset($data_question_list[$id_quest])){
                            $data_question_list[$id_quest] = array(
                                '1' => 0,
                                '2' => 0,
                                '3' => 0,
                                '4' => 0,
                                '5' => 0,
                            );
                        }
                        $now_count_list = $data_question_list[$id_quest];
                        if (array_key_exists($value,$now_count_list)){
                            $now_count = $now_count_list[$value];
                            $now_count_list[$value] = $now_count + 1;
                        }
                        $data_question_list[$id_quest] = $now_count_list;
                        break;
                    case 'select':
                        if (! isset($data_question_list[$id_quest])){
                            $data_question_list[$id_quest] = array(
                                '1' => 0,
                                '2' => 0,
                                '3' => 0,
                                '4' => 0,
                                '5' => 0,
                                '6' => 0,
                                '7' => 0,
                                '8' => 0,
                                '9' => 0,
                                '10' => 0,
                            );
                        }
                        $now_count_list = $data_question_list[$id_quest];
                        if (array_key_exists($value,$now_count_list)){
                            $now_count = $now_count_list[$value];
                            $now_count_list[$value] = $now_count + 1;
                        }
                        $data_question_list[$id_quest] = $now_count_list;
                        break;
                    case 'radio':
                        if (! isset($data_question_list[$id_quest])){
                            $data_question_list[$id_quest] = array(
                                '0' => 0,
                                '1' => 0,
                            );
                        }
                        $now_count_list = $data_question_list[$id_quest];
                        if (array_key_exists($value,$now_count_list)){
                            $now_count = $now_count_list[$value];
                            $now_count_list[$value] = $now_count + 1;
                        }
                        $data_question_list[$id_quest] = $now_count_list;
                        break;
                    case 'text':
                        if (! isset($data_question_list[$id_quest])){
                            $data_question_list[$id_quest] = array();
                        }
                        $now_count_list = $data_question_list[$id_quest];

                        if ( trim($value) !== '' ){
                            array_push($now_count_list,$value);
                        }
                        $data_question_list[$id_quest] = $now_count_list;
                        break;
                    default:
                }

            }
        }

//        echo '<pre>';
//        print_r($data_question_list);
//        echo '</pre>';

        foreach ($arr_info_question as $id_quest => $info_arr){
            $arr_client = array(
                'id_quest' => $id_quest,
                'data' => $data_question_list[$id_quest],
            );
            $x = array_merge($arr_client,$info_arr);
            //            $info_arr = array(
//                'type' => 'ruler',
//                'title' => $title,
//            );

            array_push($arr_data_question_total,$x);
        }

        return array(
            'question' => $arr_data_question_total,
            'name' => $arr_name,
            'time' => $arr_time_length,
            );
    }

    public function mark_point_class($class_code){
        $data = $this -> get_list_feedback_paper($class_code);

        $arr_info_question = array();

        $data_question_list = array();

        foreach ($data as $mono){
            $detail = json_decode($mono['detail'],true);
            foreach ($detail as $mono_detail) {
                $id_quest = $mono_detail[0];
                $type = $mono_detail[1];
                $content = $mono_detail[2];
                $value = (string) $mono_detail[3];
                if (! isset($arr_info_question[$id_quest])){
                    $arr_info_question[$id_quest] = array(
                        'type' =>   $type,
                        'title' =>   $content,
                    );
                }

                switch ($type){
                    case 'select':
                        if (! isset($data_question_list[$id_quest])){
                            $data_question_list[$id_quest] = array(
                                '1' => 0,
                                '2' => 0,
                                '3' => 0,
                                '4' => 0,
                                '5' => 0,
                                '6' => 0,
                                '7' => 0,
                                '8' => 0,
                                '9' => 0,
                                '10' => 0,
                            );
                        }
                        $now_count_list = $data_question_list[$id_quest];
                        if (array_key_exists($value,$now_count_list)){
                            $now_count = $now_count_list[$value];
                            $now_count_list[$value] = $now_count + 1;
                        }
                        $data_question_list[$id_quest] = $now_count_list;
                        break;
                    default:
                }

            }
        }

//        echo '<pre>';
//        print_r($data_question_list);
//        echo '</pre>';

        $arr_diem_trung_binh = array();
        foreach ($data_question_list as $id_question => $mono_question_list){
            $sum = 0;
            $count = 0;
            foreach ($mono_question_list as $point => $number) {
                $point_int = (int) $point;
                $sum += $point_int*$number;
                $count += $number;
            }
            if ($count != 0 ){
                $arr_diem_trung_binh[$id_question] = $sum/$count;
            }else{
                $arr_diem_trung_binh[$id_question] = 0;
            }
        }

        $sum_point_class = 0;
        $count_question = 0;
        foreach ($arr_diem_trung_binh as $id_question => $point) {
            $count_question ++ ;
            $sum_point_class += $point;
        }

        if ($count_question != 0 ){
            $average_point_class = round($sum_point_class/$count_question,2);
        }else{
            $average_point_class = 0;
        }

        $this->db->set('point', $average_point_class, FALSE);
        $this->db->where('class_code',$class_code);
        $this->db->update('feedback_class');

        return $average_point_class;
    }

    public function mark_point_all_class($type = ''){
        $list_class_code = $this->get_list_class_code($type);
//        echo '<pre>';
//        print_r($list_class_code);
//        echo '</pre>';
        foreach ($list_class_code as $mono_class_code){
            $class_code = $mono_class_code['class_code'];
            $this->mark_point_class($class_code);
        }

    }

    // Location

    public function get_list_location($area = ''){
        if ($area != ''){
            $this->db->where('area',$area);
        }
        $this->db->order_by('area', 'ASC');

        $query = $this->db->get('feedback_location');
        $arr_res = $query->result_array();
        return $arr_res;
    }

    public function insert_location($info){
//        $info = array(
//            'name' => $name,
//            'area' => $area,
//        );
        $this->db->insert('feedback_location', $info);
    }

    public function edit_location($info){
        $this->db->where('id',$info['id']);
        $this->db->replace('feedback_location', $info);
    }

    public function del_location($info){
        $this->db->delete('feedback_location', array('id' => $info['id']));
    }





}


