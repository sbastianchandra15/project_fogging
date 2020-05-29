<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pergerakan_stok extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
    }

	function index(){
        $this->load->model("barang_model");
        $this->load->model("transaksi_model");
        $this->load->model("gudang_model");
        

        $data['data_barang']= $this->barang_model->get_barang();
        $data['data_gudang']= $this->gudang_model->get_gudang();
        //test($_POST['val_tanggal'],1);
        if(isset($_POST['barang'])){
            $data['barang'] = $_POST['barang'];
            $pil_periode = $_POST['val_tanggal'];
            $bulan_tahun = date('Y-m', strtotime('-1 month', strtotime($pil_periode)));

            $data['cari'] = 'cari';
            // $data['data_stok'] = $this->transaksi_model->get_stok($bulan_tahun, $_POST['barang']);
            // $data['bulan_tahun'] = $bulan_tahun;
            // $data['pil_periode'] = $pil_periode;
            // $data['pil_bulan'] = substr($pil_periode,5,2);
            // $data['pil_tahun'] = substr($pil_periode,0,4);

            $data['data_stok'] = $this->transaksi_model->get_stok_barang($bulan_tahun, $_POST['barang'], $_POST['gudang']);
            $data['bulan_tahun'] = $bulan_tahun;
            $data['pil_periode'] = $pil_periode;
            $data['pil_bulan'] = substr($pil_periode,5,2);
            $data['pil_tahun'] = substr($pil_periode,0,4);

        }

        $this->template->load('template', 'report/pergerakan_stok', $data);
    }
	
	function report_stok(){
        $this->load->model("barang_model");
        $this->load->model("transaksi_model");
        $this->load->model("gudang_model");
        

        $data['data_barang']= $this->barang_model->get_barang();
        $data['data_gudang']= $this->gudang_model->get_gudang();
        //test($_POST['val_tanggal'],1);
        if(isset($_POST['barang'])){
            $data['barang'] = $_POST['barang'];
            $pil_periode = $_POST['val_tanggal'];
            $bulan_tahun = date('Y-m', strtotime('-1 month', strtotime($pil_periode)));

            $data['cari'] = 'cari';
            // $data['data_stok'] = $this->transaksi_model->get_stok($bulan_tahun, $_POST['barang']);
            // $data['bulan_tahun'] = $bulan_tahun;
            // $data['pil_periode'] = $pil_periode;
            // $data['pil_bulan'] = substr($pil_periode,5,2);
            // $data['pil_tahun'] = substr($pil_periode,0,4);

            $data['data_stok'] = $this->transaksi_model->get_stok_barang($bulan_tahun, $_POST['barang'], $_POST['gudang']);
            $data['bulan_tahun'] = $bulan_tahun;
            $data['pil_periode'] = $pil_periode;
            $data['pil_bulan'] = substr($pil_periode,5,2);
            $data['pil_tahun'] = substr($pil_periode,0,4);

        }

        $this->template->load('template', 'report/pergerakan_stok2', $data);

	}
}
?>