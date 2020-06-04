<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('security');
    }

    function view_pesan(){
        $this->load->model('pesan_model');
        $data['pesan_header']= $this->pesan_model->get_pesan_header();
        $this->template->load('template', 'pesan/view', $data);
    }

	function index() {
        $this->load->model('pesan_model');
        $data['pesan_header']= $this->pesan_model->get_pesan_header_customer();
        $this->template->load('template_customer', 'pesan/view', $data);
    }

    // function delete($id){
    //     $this->load->model("pesan_model");
    //     $this->pesan_model->act_delete_transaksi_masuk($id);
    //     redirect('transaksi_masuk');
    // }

    function form(){
        $this->session->unset_userdata('new_ni');

        $this->load->model("customer_model");
        $this->load->model("alat_fogging_model");
        $new_ni = $this->session->userdata('new_ni');

        if(!$new_ni){
            $new_ni = array(
                'tanggal' => false,                
                'gd_tujuan' => false,
                'keterangan' => false,
                'items' => array()
            );
        }

        $data['new_ni'] = $new_ni;
        $data['data_customer']  = $this->customer_model->get_data();
        $data['data_alat']      = $this->alat_fogging_model->get_data();
        $this->template->load('template_customer', 'pesan/form', $data);
    }

    function add_item(){
        if(!isset($_POST['id_barang'])) return;
        $new_ni = $this->session->userdata('new_ni');

        $items = $new_ni['items'];

        $exist = false;
        if($items!=''){
            foreach($items as $key=>$val){
                if($val['id_barang'] == $this->input->post('id_barang')){
                    $new_ni['items'][$key] = array(
                        'id_barang'     => $this->input->post('id_barang'),
                        'nama'          => $this->input->post('nama'),
                        'harga'         => $this->input->post('harga'),
                        'qty'           => $this->input->post('qty')
                    );
                    $exist = true;
                    break;
                }
            }
        }

        if(!$exist){
            $new_ni['items'][] = array(
                    'id_barang'     => $this->input->post('id_barang'),
                    'nama'          => $this->input->post('nama'),
                    'harga'         => $this->input->post('harga'),
                    'qty'           => $this->input->post('qty')
            );
        }
        
        $this->session->set_userdata('new_ni', $new_ni);
    }

    function save(){
        $this->load->model('pesan_model');

        $respone = $this->pesan_model->simpan();      

        $this->session->unset_userdata('new_ni');          
        jsout( array('success' => true, 'nomor_dok' => $respone )); 

    }

    function reset(){
        $this->session->unset_userdata('new_ni');
        redirect('pesan');
    }

    function remove_item(){
        if(!isset($_GET['index_code'])) return;
        $index_code = $this->input->get('index_code');
        $new_ni = $this->session->userdata('new_ni');

        $items = $new_ni['items'];

        foreach($items as $key=>$val){
            if($val['id_barang'] == $index_code){
                unset($new_ni['items'][$key]);
                $new_ni['items'] = array_values($new_ni['items']);
                break;
            }

        }

        $this->session->set_userdata('new_ni', $new_ni);
        jsout(array('success'=>1)); 
    }

    function edit($id){

        $this->session->unset_userdata('new_ni');

        $this->load->model("customer_model");
        $this->load->model("alat_fogging_model");
        $this->load->model("pesan_model");
        $new_ni = $this->session->userdata('new_ni');        

        $data_detail            = $this->pesan_model->detail($id);

        if(!$new_ni){
            $new_ni = array(
                'items' => array()
            );
        }

        foreach($data_detail as $key=>$val){
            $new_ni['items'][$key] = array(
                'id_barang'         => $val->id_alat,
                'qty'               => $val->qty,
                'harga'             => $val->harga,
                'nama'              => $val->nama
            );
        }

        $this->session->set_userdata('new_ni', $new_ni);
        $data['new_ni']         = $new_ni;
        $data['data_customer']  = $this->customer_model->get_data();
        $data['data_alat']      = $this->alat_fogging_model->get_data();
        $data['header']         = $this->pesan_model->header($id);
        
        $this->template->load('template_customer', 'pesan/edit', $data);

    }    

    function edit_save(){
        $this->load->model('pesan_model');

        $respone = $this->pesan_model->update();      

        $this->session->unset_userdata('new_ni');          
        jsout( array('success' => true, 'nomor_dok' => $respone )); 

    }

    function delete(){
        $id             = $this->input->post('id');
        $this->db->query("DELETE FROM db_pro_fogging.pesan_detail WHERE no_pesan = '".$id."'");
        $this->db->query("DELETE FROM db_pro_fogging.pesan_header WHERE no_pesan = '".$id."'");


    }
}
