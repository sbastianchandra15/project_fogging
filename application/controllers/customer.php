<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
        $this->load->model("customer_model");
    }

	function index(){
        $data['data_view']= $this->customer_model->get_data();
        $this->template->load('template', 'customer/view', $data);
    }

    function delete(){
        $this->load->model("customer_model");
        $no_ktp             = $this->input->post('no_ktp');
        $delete             = $this->customer_model->act_delete($no_ktp);
    }

    function form(){
        $this->template->load('template', 'customer/form');
    }

    function form_act(){
        $this->load->model("customer_model");
        $save       = $this->customer_model->act_form();
    }

    function edit($id){
        $this->load->model("customer_model");
        $data['detail']         = $this->customer_model->detail($id);

        $this->template->load('template', 'customer/edit', $data);
    }

    function edit_act(){
        $this->load->model("customer_model");
        $save       = $this->customer_model->act_edit();
    }

    function report(){
        $this->load->model("customer_model");
        $data['data_barang']= $this->customer_model->get_barang();
        $this->template->load('template', 'report/report_barang', $data);
    }
}
?>