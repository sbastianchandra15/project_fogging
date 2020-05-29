<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');  
    }

	function index($menu_detail = false) {
		$this->load->model("menu_model");
		//test($menu_detail,1);
		$data['akses_menu'] = $this->menu_model->akses_menu($menu_detail);
        $data['my_content'] = $this->security->xss_clean($menu_detail);
        $this->load->view('header');
        $this->load->view('content', $data);
        $this->load->view('footer');
    }
}
?>