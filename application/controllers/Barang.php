<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
    }

	function index(){
        $this->load->model("barang_model");
        $data['data_barang']= $this->barang_model->get_barang();
        $this->template->load('template', 'master/barang_view', $data);
    }

    function delete($id){
        $this->load->model("barang_model");
        $this->barang_model->act_delete($id);
        redirect('barang');
    }

    function form(){
        $this->template->load('template', 'master/barang_form');
    }

    function form_act(){
        $this->load->model("barang_model");
        $save       = $this->barang_model->act_form();

        redirect('barang');
        $this->form_validation->set_message('info', 'Data Berhasil di simpan ');
    }

    function edit($id){
        $this->load->model("barang_model");
        $data['detail']         = $this->barang_model->detail($id);

        $this->template->load('template', 'master/barang_edit', $data);
    }

    function edit_act(){
        $this->load->model("barang_model");
        $save       = $this->barang_model->act_edit();

        $this->form_validation->set_message('info', 'Data Berhasil di simpan ');
        redirect('barang');
    }

    function report(){
        $this->load->model("barang_model");
        $data['data_barang']= $this->barang_model->get_barang();
        $this->template->load('template', 'report/report_barang', $data);
    }
}
?>