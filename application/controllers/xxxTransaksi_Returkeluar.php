<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_returkeluar extends CI_Controller {

	function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('security');
    }

	function index() {
        $this->load->model('transaksi_model');
        $data['data_transaksi_masuk']= $this->transaksi_model->get_transaksi_retur_keluar();
        $this->template->load('template', 'transaksi/rk_trn_view', $data);
    }

    function delete($id){
        $this->load->model("transaksi_model");
        $this->transaksi_model->act_delete_transaksi_retur_keluar($id);
        redirect('transaksi_returkeluar');
    }

    function form(){
        // $this->load->model("supplier_model");
        $this->load->model("toko_model");
        $this->load->model("barang_model");
        $this->load->model("gudang_model");

        $this->session->unset_userdata('new_ni');

        $new_ni = $this->session->userdata('new_ni');

        if(!$new_ni){
            $new_ni = array(
                'tanggal' => false,
                // 'id_supplier' => false,
                'gd_tujuan' => false,
                'keterangan' => false,
                'id_toko'   =>false,
                'items' => array()
            );
        }

        $data['new_ni'] = $new_ni;
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        // $data['data_supplier'] = $this->supplier_model->get_supplier();
        $data['data_toko'] = $this->toko_model->get_toko(); 
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->template->load('template', 'transaksi/rk_trn_form', $data);
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

        $gd_tujuan = $this->input->post('gd_tujuan');
        if($gd_tujuan) $new_ni['gd_tujuan'] = $gd_tujuan;

        $id_toko = $this->input->post('id_toko');
        if($id_toko) $new_ni['id_toko'] = $id_toko;

        // $id_supplier = $this->input->post('id_supplier');
        // if($id_supplier) $new_ni['id_supplier'] = $id_supplier;

        $keterangan = $this->input->post('keterangan');
        if($keterangan) $new_ni['keterangan'] = $keterangan;

        
        $this->session->set_userdata('new_ni', $new_ni);
        
    }

    function reset(){
        $this->session->unset_userdata('new_ni');
        redirect('transaksi_returkeluar');
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
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->save_transaksi_retur_keluar();      

        $this->session->unset_userdata('new_ni');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function edit($id){
        // $this->load->model("supplier_model");
        $this->load->model("toko_model");
        $this->load->model("barang_model");
        $this->load->model("gudang_model");
        $this->load->model("transaksi_model");

        $new_ni = $this->session->userdata('new_ni');

        $data_header    = $this->transaksi_model->get_transaksi_masuk_header($id);
        $data_detail    = $this->transaksi_model->get_transaksi_masuk_detail($id);

        if(!$new_ni){
            $new_ni = array(
                'tanggal' => $data_header->tgl,
                'id_toko' => $data_header->id_toko,
                'keterangan' => $data_header->keterangan,
                'gd_tujuan' => $data_header->gd_tujuan,
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
        // $data['data_supplier'] = $this->supplier_model->get_supplier();
        $data['data_toko'] = $this->toko_model->get_toko(); 
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->template->load('template', 'transaksi/rk_trn_edit', $data);
    }

    function edit_save(){
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->edit_transaksi_retur_keluar();      

        $this->session->unset_userdata('new_ni');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function cetak($id){
        $this->load->model('transaksi_model');   

        $data_header    = $this->transaksi_model->get_transaksi_masuk_header($id);
        $data_detail    = $this->transaksi_model->get_transaksi_masuk_detail($id);

        $data['data_header']    = $this->transaksi_model->get_transaksi_masuk_header($id);
        $data['data_detail']    = $this->transaksi_model->get_transaksi_masuk_detail($id);

        $this->load->view('transaksi/rk_trn_print', $data);
        //$this->template->load('template', 'transaksi/rk_trn_print', $data);
    }
}
