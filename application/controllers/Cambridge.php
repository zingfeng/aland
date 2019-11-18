<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cambridge extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Template');
    }

    public function index()
    {
        $data = array();
        $this->template->load('layout_cambridge', 'cambridge/index', $data);
    }
}