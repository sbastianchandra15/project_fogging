<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_mutasi extends CI_Controller {

	function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->helper('security');
    }

	function index() {
        $this->load->model('transaksi_model');
        $data['data_transaksi_mutasi']= $this->transaksi_model->get_transaksi_mutasi();
        $this->template->load('template', 'transaksi/mutasi_trn_view', $data);
    }

    function delete($id){
        $this->load->model("transaksi_model");
        $this->transaksi_model->act_delete_transaksi_keluar($id);
        redirect('Transaksi_mutasi');
    }

    function form(){
        $this->load->model("barang_model");
        $this->load->model("gudang_model");
        //$this->session->unset_userdata('new_tbm');

        $new_tbm = $this->session->userdata('new_tbm');

        if(!$new_tbm){
            $new_tbm = array(
                'tanggal' => false,
                'keterangan' => false,
                'gd_pengambilan' => false,
                'gd_tujuan' => false,
                'items' => array()
            );
        }

        $data['new_tbm'] = $new_tbm;
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->template->load('template', 'transaksi/mutasi_trn_form', $data);
    }

    function add_item(){
        if(!isset($_POST['id_barang'])) return;
        $new_tbm = $this->session->userdata('new_tbm');

        $items = $new_tbm['items'];

        $exist = false;
        if($items!=''){
        foreach($items as $key=>$val){
                if($val['id_barang'] == $this->input->post('id_barang')){
                    $new_tbm['items'][$key] = array(
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
            $new_tbm['items'][] = array(
                    'id_barang'         => $this->input->post('id_barang'),
                    'kd_barang'         => $this->input->post('kd_barang'),
                    'qty'               => $this->input->post('qty')
            );
        }

        $tanggal = $this->input->post('tanggal');
        if($tanggal) $new_tbm['tanggal'] = $tanggal;

        $keterangan = $this->input->post('keterangan');
        if($keterangan) $new_tbm['keterangan'] = $keterangan;

        $gd_pengambilan = $this->input->post('gd_pengambilan');
        if($gd_pengambilan) $new_tbm['gd_pengambilan'] = $gd_pengambilan;

        $gd_tujuan = $this->input->post('gd_tujuan');
        if($gd_tujuan) $new_tbm['gd_tujuan'] = $gd_tujuan;
        
        $this->session->set_userdata('new_tbm', $new_tbm);        
    }

    function reset(){
        $this->session->unset_userdata('new_tbm');
        redirect('Transaksi_mutasi');
    }

    function remove_item(){
        if(!isset($_GET['index_code'])) return;
        $index_code = $this->input->get('index_code');
        $new_tbm = $this->session->userdata('new_tbm');

        $items = $new_tbm['items'];

        foreach($items as $key=>$val){
            if($val['kd_barang'] == $index_code){
                unset($new_tbm['items'][$key]);
                $new_tbm['items'] = array_values($new_tbm['items']);
                break;
            }
        }

        $this->session->set_userdata('new_tbm', $new_tbm);
        jsout(array('success'=>1)); 
    }

    function save(){
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->save_transaksi_mutasi();      

        $this->session->unset_userdata('new_tbm');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function edit($id){
        $this->load->model("barang_model");
        $this->load->model("transaksi_model");
        $this->load->model("gudang_model");

        $new_tbm = $this->session->userdata('new_tbm');

        $data_header    = $this->transaksi_model->get_transaksi_mutasi_header($id);
        $data_detail    = $this->transaksi_model->get_transaksi_masuk_detail($id);
        // test($data_header->tgl,1);
        if(!$new_tbm){
            $new_tbm = array(
                'tanggal' => $data_header->tgl,
                'gd_pengambilan'=>$data_header->gd_pengambilan,
                'gd_tujuan'=>$data_header->gd_tujuan,
                'keterangan' => $data_header->keterangan,
                'id_trans' => $id,
                'kd_trans' => $data_header->kd_trans,
            );
        }

        foreach($data_detail as $key=>$val){
            $new_tbm['items'][$key] = array(
                'id_barang'         => $val->id_barang,
                'kd_barang'         => $val->kd_barang,
                'qty'               => $val->qty
            );
        }

        $this->session->set_userdata('new_tbm', $new_tbm);
        $data['new_tbm'] = $new_tbm;
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->template->load('template', 'transaksi/mutasi_trn_edit', $data);
    }

    function edit_save(){
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->edit_transaksi_mutasi();      

        $this->session->unset_userdata('new_tbm');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function cetak($id){
        $this->load->model('transaksi_model');   

        $data['data_header']    = $this->transaksi_model->get_transaksi_keluar_header($id);
        $data['data_detail']    = $this->transaksi_model->get_transaksi_masuk_detail($id);

        $this->load->view('transaksi/mutasi_trn_print', $data);
        //$this->template->load('template', 'transaksi/mutasi_trn_print', $data);
    }
}
