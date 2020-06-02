<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('security');
    }

	function index() {
        $this->load->model('pesan_model');
        $data['pesan_header']= $this->pesan_model->get_pesan_header();
        $this->template->load('template', 'pesan/view', $data);
    }

    function delete($id){
        $this->load->model("pesan_model");
        $this->pesan_model->act_delete_transaksi_masuk($id);
        redirect('transaksi_masuk');
    }

    function form(){
        
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
        $this->template->load('template', 'pesan/form', $data);
    }

    function add_item(){
        if(!isset($_POST['id_barang'])) return;
        $new_ni = $this->session->userdata('new_ni');
        // if(!$new_ni) return false;

        $items = $new_ni['items'];

        $exist = false;
        if($items!=''){
            foreach($items as $key=>$val){
                if($val['id_barang'] == $this->input->post('id_barang')){
                    $new_ni['items'][$key] = array(
                        'id_barang'         => $this->input->post('id_barang'),
                        'kd_barang'         => $this->input->post('kd_barang'),
                        'qty'               => $this->input->post('qty')
                    );
                    $exist = true;
                    break;
                }
            }
        }

        if(!$exist){
            $new_ni['items'][] = array(
                    'id_barang'         => $this->input->post('id_barang'),
                    'kd_barang'         => $this->input->post('kd_barang'),
                    'qty'               => $this->input->post('qty')
            );
        }

        $tanggal = $this->input->post('tanggal');
        if($tanggal) $new_ni['tanggal'] = $tanggal;

        //$id_supplier = $this->input->post('id_supplier');
        //if($id_supplier) $new_ni['id_supplier'] = $id_supplier;


        //$id_supplier = $this->input->post('id_supplier');
        //if($id_supplier) $new_ni['id_supplier'] = $id_supplier;

        $keterangan = $this->input->post('keterangan');
        if($keterangan) $new_ni['keterangan'] = $keterangan;

        $gd_tujuan = $this->input->post('gd_tujuan');
        if($gd_tujuan) $new_ni['gd_tujuan'] = $gd_tujuan;

        
        $this->session->set_userdata('new_ni', $new_ni);
        //test($new_ni,1);
    }

    function reset(){
        $this->session->unset_userdata('new_ni');
        redirect('transaksi_masuk');
    }

    function remove_item(){
        if(!isset($_GET['index_code'])) return;
        $index_code = $this->input->get('index_code');
        $new_ni = $this->session->userdata('new_ni');

        $items = $new_ni['items'];

        foreach($items as $key=>$val){
            if($val['kd_barang'] == $index_code){
                unset($new_ni['items'][$key]);
                $new_ni['items'] = array_values($new_ni['items']);
                break;
            }
        }

        $this->session->set_userdata('new_ni', $new_ni);
        jsout(array('success'=>1)); 
    }

    function save(){
        $this->load->model('pesan_model');
        $respone = $this->pesan_model->save_transaksi_masuk();      

        $this->session->unset_userdata('new_ni');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function edit($id){
        $this->load->model("barang_model");
        $this->load->model("pesan_model");
        $this->load->model("gudang_model");
        //$this->load->model("supplier_model");

        $new_ni = $this->session->userdata('new_ni');

        $data_header    = $this->pesan_model->get_transaksi_masuk_header($id);
        $data_detail    = $this->pesan_model->get_transaksi_masuk_detail($id);

        if(!$new_ni){
            $new_ni = array(
                'tanggal' => $data_header->tgl,
                'gd_tujuan' => $data_header->gd_tujuan,
                'keterangan' => $data_header->keterangan,
                //'id_supplier'=> $data_header->id_supplier,
                'id_trans' => $id,
                'kd_trans' => $data_header->kd_trans,
            );
        }

        foreach($data_detail as $key=>$val){
            $new_ni['items'][$key] = array(
                'id_barang'         => $val->id_barang,
                'kd_barang'         => $val->kd_barang,
                'qty'               => $val->qty
            );
        }

        $this->session->set_userdata('new_ni', $new_ni);
        $data['new_ni'] = $new_ni;
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        $data['data_barang'] = $this->barang_model->get_barang();
        //$data['data_supplier']  = $this->supplier_model->get_supplier();
        $this->template->load('template', 'transaksi/masuk_trn_edit', $data);
    }

    function edit_save(){
        $this->load->model('pesan_model');
        $respone = $this->pesan_model->edit_transaksi_masuk();      

        $this->session->unset_userdata('new_ni');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function cetak($id){
        $this->load->model('pesan_model');   

        $data_header    = $this->pesan_model->get_transaksi_masuk_header($id);
        $data_detail    = $this->pesan_model->get_transaksi_masuk_detail($id);

        $data['data_header']    = $this->pesan_model->get_transaksi_masuk_header($id);
        $data['data_detail']    = $this->pesan_model->get_transaksi_masuk_detail($id);

        $this->load->view('transaksi/masuk_trn_print', $data);
        //$this->template->load('template', 'transaksi/masuk_trn_print', $data);
    }
}
