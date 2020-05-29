<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
    }

	function index(){
        $this->load->model("supplier_model");
        $data['data_supplier']= $this->supplier_model->get_supplier();
        $this->template->load('template', 'master/supplier_view', $data);
    }

    function delete($id){
        $this->load->model("supplier_model");
        $this->supplier_model->act_delete($id);
        redirect('supplier');
    }

    function form(){
        $this->template->load('template', 'master/supplier_form');
    }

    function form_act(){
        $this->load->model("supplier_model");
        $save       = $this->supplier_model->act_form();

        redirect('supplier');
        $this->form_validation->set_message('info', 'Data Berhasil di simpan ');
    }

    function edit($id){
        $this->load->model("supplier_model");
        
        $data['detail']         = $this->supplier_model->detail($id);

        $this->template->load('template', 'master/supplier_edit', $data);
    }

    function edit_act(){
        $this->load->model("supplier_model");
        $save       = $this->supplier_model->act_edit();

        $this->form_validation->set_message('info', 'Data Berhasil di simpan ');
        redirect('supplier');
    }

    function report(){
        $this->load->model("supplier_model");
        $data['data_supplier']= $this->supplier_model->get_supplier();
        $this->template->load('template', 'report/report_supplier', $data);
    }
}
?>