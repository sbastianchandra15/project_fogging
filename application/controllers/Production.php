<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

	function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('security');
    }

	function index() {
        $this->load->model('transaksi_model');
        $data['data_production']= $this->transaksi_model->get_production();
        $this->template->load('template', 'transaksi/production_trn_view', $data);
    }

    function delete($id){
        $this->load->model("transaksi_model");
        $this->transaksi_model->act_delete_transaksi_production($id);
        redirect('production');
    }

    function form(){
        $this->load->model("barang_model");
        $this->load->model("gudang_model");

        //$this->session->unset_userdata('new_prod');

        $new_prod = $this->session->userdata('new_prod');

        if(!$new_prod){
            $new_prod = array(
                'tanggal' => false,
                'id_gudang' => false,
                'id_barang_jadi' => false,
                'qty_jadi' => false,
                'items' => array()
            );
        }

        $data['new_prod'] = $new_prod;
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        $data['data_barang'] = $this->barang_model->get_barang();
        $data['data_barang_jadi'] = $this->barang_model->get_barang_jadi();
        $data['data_barang_mentah'] = $this->barang_model->get_barang_mentah();
        $this->template->load('template', 'transaksi/production_trn_form', $data);
    }

    function add_item(){
        //test($_POST['id_barang'],1);
        if(!isset($_POST['id_barang'])) return;
        $new_prod = $this->session->userdata('new_prod');
        // if(!$new_prod) return false;

        $items = $new_prod['items'];

        $exist = false;
        if($items!=''){
            foreach($items as $key=>$val){
                if($val['id_barang'] == $this->input->post('id_barang')){
                    $new_prod['items'][$key] = array(
                        'id_barang'         => $this->input->post('id_barang'),
                        'kd_barang'         => $this->input->post('kd_barang'),
                        'qty'               => $this->input->post('qty'),
                        'id_gudang'         => $this->input->post('id_gudang'), 
                        'gudang'            => $this->input->post('gudang')
                    );
                    $exist = true;
                    break;
                }
            }
        }

        if(!$exist){
            $new_prod['items'][] = array(
                    'id_barang'         => $this->input->post('id_barang'),
                    'kd_barang'         => $this->input->post('kd_barang'),
                    'qty'               => $this->input->post('qty'),
                    'id_gudang'         => $this->input->post('id_gudang'), 
                    'gudang'            => $this->input->post('gudang')
            );
        }

        $tanggal = $this->input->post('tanggal');
        if($tanggal) $new_prod['tanggal'] = $tanggal;

        $gd_tujuan = $this->input->post('gd_tujuan');
        if($gd_tujuan) $new_prod['gd_tujuan'] = $gd_tujuan;

        $id_barang_jadi = $this->input->post('id_barang_jadi');
        if($id_barang_jadi) $new_prod['id_barang_jadi'] = $id_barang_jadi;

        $qty_jadi = $this->input->post('qty_jadi');
        if($qty_jadi) $new_prod['qty_jadi'] = $qty_jadi;

        
        $this->session->set_userdata('new_prod', $new_prod);
        
    }

    function reset(){
        $this->session->unset_userdata('new_prod');
        redirect('production');
    }

    function remove_item(){
        if(!isset($_GET['index_code'])) return;
        $index_code = $this->input->get('index_code');
        $new_prod = $this->session->userdata('new_prod');

        $items = $new_prod['items'];

        foreach($items as $key=>$val){
            if($val['kd_barang'] == $index_code){
                unset($new_prod['items'][$key]);
                $new_prod['items'] = array_values($new_prod['items']);
                break;
            }
        }

        $this->session->set_userdata('new_prod', $new_prod);
        jsout(array('success'=>1)); 
    }

    function save(){
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->save_production();      

        $this->session->unset_userdata('new_prod');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function edit($id){
        $this->load->model("barang_model");
        $this->load->model("transaksi_model");
        $this->load->model("gudang_model");

        $new_prod = $this->session->userdata('new_prod');

        $data_header    = $this->transaksi_model->get_transaksi_masuk_header($id);
        $data_detail    = $this->transaksi_model->get_transaksi_masuk_detail($id);

        if(!$new_prod){
            $new_prod = array(
                'tanggal' => $data_header->tgl,
                'gd_tujuan' => $data_header->gd_tujuan,
                'keterangan' => $data_header->keterangan,
                'id_trans' => $id,
                'kd_trans' => $data_header->kd_trans,
            );
        }

        foreach($data_detail as $key=>$val){
            $new_prod['items'][$key] = array(
                'id_barang'         => $val->id_barang,
                'kd_barang'         => $val->kd_barang,
                'qty'               => $val->qty
            );
        }

        $this->session->set_userdata('new_prod', $new_prod);
        $data['new_prod'] = $new_prod;
        $data['data_gudang'] = $this->gudang_model->get_gudang();
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->template->load('template', 'transaksi/masuk_trn_edit', $data);
    }

    function edit_save(){
        $this->load->model('transaksi_model');
        $respone = $this->transaksi_model->edit_transaksi_masuk();      

        $this->session->unset_userdata('new_prod');          
        jsout( array('success' => true, 'nomor_dok' => $respone ));   
    }

    function cetak($id){
        $this->load->model('transaksi_model');   

        $data['data_header']    = $this->transaksi_model->get_production_header($id);
        $data['data_detail']    = $this->transaksi_model->get_production_detail($id);

        $this->template->load('template', 'transaksi/production_trn_print', $data);
    }
}
