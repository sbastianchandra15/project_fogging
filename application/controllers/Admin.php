<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
        $this->load->model("admin_model");
    }

	function index(){
        $data['data_view']= $this->admin_model->get_data();
        $this->template->load('template', 'admin/view', $data);
    }

    function delete(){
        $this->load->model("admin_model");
        $id             = $this->input->post('id');
        $delete         = $this->admin_model->act_delete($id);
    }

    function form(){
        $this->template->load('template', 'admin/form');
    }

    function form_act(){
        $this->load->model("admin_model");
        $save       = $this->admin_model->act_form();
    }

    function edit($id){
        $this->load->model("admin_model");
        $data['detail']         = $this->admin_model->detail($id);

        $this->template->load('template', 'admin/edit', $data);
    }

    function edit_act(){
        $this->load->model("admin_model");
        $save       = $this->admin_model->act_edit();
    }

    function report(){
        $this->load->model("admin_model");
        $data['data_barang']= $this->admin_model->get_barang();
        $this->template->load('template', 'report/report_barang', $data);
    }
}
?>