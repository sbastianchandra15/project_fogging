<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keluar extends CI_Controller {

	function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->helper('security');
    }

	function index() {
        $this->load->model('transaksi_model');
        $data['data_transaksi_masuk']= $this->transaksi_model->get_transaksi_keluar();
        $this->template->load('template', 'transaksi/keluar_trn_view', $data);
    }

    function delete($id){
        $this->load->model("transaksi_model");
        $this->transaksi_model->act_delete_transaksi_keluar($id);
        redirect('transaksi_keluar');
    }

    function form(){
        $this->load->model("barang_model");
        $this->load->model("gudang_model");
        $this->load->model("toko_model");
        //$this->session->unset_userdata('new_tbk');

        $new_tbk = $this->session->userdata('new_tbk');

        if(!$new_tbk){
            $new_tbk = array(
                'tanggal' => false,
                'id_toko' => false,
                'keterangan' => false,
                'items' => array()
            );
        }

        $data['new_tbk'] = $new_tbk;
        $data['data_toko']  = $this->toko_model->get_toko();
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->template->load('template', 'transaksi/keluar_trn_form', $data);
    }

    function add_item(){
        if(!isset($_POST['id_barang'])) return;
        $new_tbk = $this->session->userdata('new_tbk');
        $items = $new_tbk['items'];

        $exist = false;
        if($items!=''){
        foreach($items as $key=>$val){
                if($val['id_barang'] == $this->input->post('id_barang')){
                    $new_tbk['items'][$key] = array(
                        'id_barang'         => $this->input->post('id_barang'),
                        'kd_barang'         => $this->input->post('kd_barang'),
                        'nama_barang'       => $this->input->post('nama_barang'),
                        'qty'               => $this->input->post('qty')
                    );
                    $exist = true;
                    break;
                }
            }
        }

        if(!$exist){
            $new_tbk['items'][] = array(
                    'id_barang'         => $this->input->post('id_barang'),
                    'kd_barang'         => $this->input->post('kd_barang'),
                    'nama_barang'       => $this->input->post('nama_barang'),
                    'qty'               => $this->input->post('qty')
            );
        }

        $tanggal = $this->input->post('tanggal');
        if($tanggal) $new_tbk['tanggal'] = $tanggal;

        $keterangan = $this->input->post('keterangan');
        if($keterangan) $new_tbk['keterangan'] = $keterangan;

        $id_toko = $this->input->post('id_toko');
        if($id_toko) $new_tbk['id_toko'] = $id_toko;

        $gd_pengambilan = $this->input->post('gd_pengambilan');
        if($gd_pengambilan) $new_tbk['gd_pengambilan'] = $gd_pengambilan;
        
        $this->session->set_userdata('new_tbk', $new_tbk);        
    }

    function reset(){
        $this->session->unset_userdata('new_tbk');
        redirect('transaksi_keluar');
    }

    function remove_item(){
        if(!isset($_GET['index_code'])) return;
        $index_code = $this->input->get('index_code');
        $new_tbk = $this->session->userdata('new_tbk');

        $items = $new_tbk['items'];

        foreach($items as $key=>$val){
            if($val['kd_barang'] == $index_code){
                unset($new_tbk['items'][$key]);
                $new_tbk['items'] = array_values($new_tbk['items']);
                break;
            }
        }

        $this->session->set_userdata('new_tbk', $new_tbk);
        jsout(array('success'=>1)); 
    }

    function save(){
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->save_transaksi_keluar();      

        $this->session->unset_userdata('new_tbk');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function edit($id){
        $this->load->model("barang_model");
        $this->load->model("transaksi_model");
        $this->load->model("gudang_model");
        $this->load->model("toko_model");

        $new_tbk = $this->session->userdata('new_tbk');
        //test($new_tbk,1);
        $data_header    = $this->transaksi_model->get_transaksi_masuk_header($id);
        $data_detail    = $this->transaksi_model->get_transaksi_masuk_detail($id);
        // test($data_header->tgl,1);
        if(!$new_tbk){
            $new_tbk = array(
                'tanggal' => $data_header->tgl,
                'id_toko' => $data_header->id_toko,
                'gd_pengambilan'=>$data_header->gd_pengambilan,
                'keterangan' => $data_header->keterangan,
                'id_trans' => $id,
                'kd_trans' => $data_header->kd_trans,
            );
        }

        foreach($data_detail as $key=>$val){
            $new_tbk['items'][$key] = array(
                'id_barang'         => $val->id_barang,
                'kd_barang'         => $val->kd_barang,
                'qty'               => $val->qty
            );
        }

        $this->session->set_userdata('new_tbk', $new_tbk);
        $data['new_tbk'] = $new_tbk;
        $data['data_toko']  = $this->toko_model->get_toko();
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->template->load('template', 'transaksi/keluar_trn_edit', $data);
    }

    function edit_save(){
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->edit_transaksi_keluar();      

        $this->session->unset_userdata('new_tbk');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function cetak($id){
        $this->load->model('transaksi_model');   

        $data['data_header']    = $this->transaksi_model->get_transaksi_keluar_header($id);
        $data['data_detail']    = $this->transaksi_model->get_transaksi_masuk_detail($id);

        $this->load->view('transaksi/keluar_trn_print', $data);
        //$this->template->load('template', 'transaksi/keluar_trn_print', $data);
    }
}
