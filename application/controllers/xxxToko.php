<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
    }

	function index(){
        $this->load->model("toko_model");
        $data['data_toko']= $this->toko_model->get_toko();
        $this->template->load('template', 'master/toko_view', $data);
    }

    function delete($id){
        $this->load->model("toko_model");
        $this->toko_model->act_delete($id);
        redirect('toko');
    }

    function form(){
        $this->template->load('template', 'master/toko_form');
    }

    function form_act(){
        $this->load->model("toko_model");
        $save       = $this->toko_model->act_form();

        redirect('toko');
        $this->form_validation->set_message('info', 'Data Berhasil di simpan ');
    }

    function edit($id){
        $this->load->model("toko_model");
        
        $data['detail']         = $this->toko_model->detail($id);

        $this->template->load('template', 'master/toko_edit', $data);
    }

    function edit_act(){
        $this->load->model("toko_model");
        $save       = $this->toko_model->act_edit();

        $this->form_validation->set_message('info', 'Data Berhasil di simpan');
        redirect('toko');
    }

    function report(){
        $this->load->model("toko_model");
        $data['data_toko']= $this->toko_model->get_toko();
        $this->template->load('template', 'report/report_toko', $data);
    }
}
?>