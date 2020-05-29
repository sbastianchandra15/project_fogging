<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
        $this->load->model("kategori_model");
    }

	function index(){
        $data['data_view']= $this->kategori_model->get_data();
        $this->template->load('template', 'kategori/view', $data);
    }

    function delete(){
        $this->load->model("kategori_model");
        $id             = $this->input->post('id');
        $delete         = $this->kategori_model->act_delete($id);
    }

    function form(){
        $this->template->load('template', 'kategori/form');
    }

    function form_act(){
        $this->load->model("kategori_model");
        $save       = $this->kategori_model->act_form();
    }

    function edit($id){
        $this->load->model("kategori_model");
        $data['detail']         = $this->kategori_model->detail($id);

        $this->template->load('template', 'kategori/edit', $data);
    }

    function edit_act(){
        $this->load->model("kategori_model");
        $save       = $this->kategori_model->act_edit();
    }

    function report(){
        $this->load->model("kategori_model");
        $data['data_barang']= $this->kategori_model->get_barang();
        $this->template->load('template', 'report/report_barang', $data);
    }
}
?>