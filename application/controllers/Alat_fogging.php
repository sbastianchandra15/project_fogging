<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat_fogging extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
        $this->load->model("alat_fogging_model");
        $this->load->model("kategori_model");
    }

	function index(){
        $data['data_view']= $this->alat_fogging_model->get_data();
        $this->template->load('template', 'alat_fogging/view', $data);
    }

    function delete(){
        $this->load->model("alat_fogging_model");
        $id             = $this->input->post('id');
        $delete         = $this->alat_fogging_model->act_delete($id);
    }

    function form(){
        $data['data_kategori']          = $this->kategori_model->get_data();
        $this->template->load('template', 'alat_fogging/form',$data);
    }

    function form_act(){
        $this->load->model("alat_fogging_model");
        $save       = $this->alat_fogging_model->act_form();
    }

    function edit($id){
        $this->load->model("alat_fogging_model");
        $data['data_kategori']          = $this->kategori_model->get_data();
        $data['detail']                 = $this->alat_fogging_model->detail($id);

        $this->template->load('template', 'alat_fogging/edit', $data);
    }

    function edit_act(){
        $this->load->model("alat_fogging_model");
        $save       = $this->alat_fogging_model->act_edit();
    }

    function report(){
        $this->load->model("alat_fogging_model");
        $data['data_barang']= $this->alat_fogging_model->get_barang();
        $this->template->load('template', 'report/report_barang', $data);
    }
}
?>