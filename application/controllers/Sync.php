<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync extends CI_Controller
{
    // A product of Speedcode Style of Zingfeng
    // Start in 09:20 AM - Aug 12 2019

    public function index()
    {
        // define root folder
        // - Server A and server B
        // Sync from

        $local = 'uploads/files';
        $local_list = $this -> get_dir_local($local, 2);

        $url = 'https://www.aland.edu.vn/sync/api';
        $remote = 'uploads/files';
        $remote_list = $this->get_dir_remote($url,$remote,2);

        if ( ( is_array($local_list) && (is_array($remote_list)) ) ){
            $list_file_need_get = array_diff($remote_list,$local_list);
            DumpArrPreTag($list_file_need_get);



        }else{
            echo ' Something Wrong ';
            var_dump($local_list);
            var_dump($remote_list);
        }



    }

    private function get_dir_remote($url, $dir,$type = 0){
        $param = array(
            'type'  => $type,
            'dir'  => $dir,
        );

//        $url = 'https://thor.daybreak.icu/api/list_file';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, count($param));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

    /**
     * @param $dir
     * @param int $type = 0: file and folder, 1 la file , 2 la folder
     * @return array
     */
    private function get_dir_local($dir, $type = 0){
        $arr_file = array();
        $arr_folder = array();
        $list = scandir($dir);
        foreach ($list as $item){
            if(is_file($dir.$item)){
                array_push($arr_file,$item);
            }else{
                array_push($arr_folder,$item);
            }
        }
        switch ($type){
            case 1:
                return $arr_file;
                break;
            case 2:
                return $arr_folder;
                break;
            default:
                return array($arr_folder,$arr_file);
        }
    }

    // ============== API để nói chuyện vs Server khác
    public function api(){
        if (isset($_POST['type'])){
            $type = $_POST['type'];
        }else{
            $type = 0;
        }

        if (isset($_POST['dir'])){
            $dir = $_POST['dir'];
            if (!is_dir($dir) ){
                echo 'Dir is Not good ';
                exit;
            }
        }else{
            exit;
        }

        $res = $this->get_dir_local($dir,$type);
        echo json_encode($res);
    }


    // func tester ...
    public function test($func,$input){


    }

}
