<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
    }

	function index(){
        $this->load->model("gudang_model");
        $data['data_gudang']= $this->gudang_model->get_gudang();
        $this->template->load('template', 'master/gudang_view', $data);
    }

    function delete($id){
        $this->load->model("gudang_model");
        $this->gudang_model->act_delete($id);
        redirect('gudang');
    }

    function form(){
        $this->template->load('template', 'master/gudang_form');
    }

    function form_act(){
        $this->load->model("gudang_model");
        $save       = $this->gudang_model->act_form();

        redirect('gudang');
        $this->form_validation->set_message('info', 'Data Berhasil di simpan ');
    }

    function edit($id){
        $this->load->model("gudang_model");
        
        $data['detail']         = $this->gudang_model->detail($id);

        $this->template->load('template', 'master/gudang_edit', $data);
    }

    function edit_act(){
        $this->load->model("gudang_model");
        $save       = $this->gudang_model->act_edit();

        $this->form_validation->set_message('info', 'Data Berhasil di simpan ');
        redirect('gudang');
    }

    function report(){
        $this->load->model("gudang_model");
        $data['data_gudang']= $this->gudang_model->get_gudang();
        $this->template->load('template', 'report/report_gudang', $data);
    }
}
?>