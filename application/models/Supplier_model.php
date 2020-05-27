<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
	function get_supplier()
    {
        $sql =  "SELECT     `id_supplier`, `kode_supplier`, `nama`, `alamat`, `telp`, `aktif` FROM `supplier` WHERE aktif='1'";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_delete($id){
        $sql = "UPDATE `supplier` SET `aktif` = '0' WHERE `id_supplier` = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }


    function act_form(){
        $sql = "INSERT INTO `supplier` 
                (`kode_supplier`, `nama`, `alamat`, `telp`, `aktif`)VALUES
                ( '".$this->input->post('kd_supplier')."', '".$this->input->post('nama_supplier')."', '".$this->input->post('alamat')."', '".$this->input->post('telp')."', '".$this->input->post('aktif')."')";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        $sql = "SELECT  `id_supplier`, `kode_supplier`, `nama`, `alamat`, `telp`, `aktif` FROM `supplier` 
                WHERE id_supplier='".$id."'";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function act_edit(){
        $sql = "UPDATE `supplier` SET
                        `kode_supplier` = '".$this->input->post('kd_supplier')."',
                        `nama` = '".$this->input->post('nama_supplier')."',
                        `alamat` = '".$this->input->post('alamat')."',
                        `telp` = '".$this->input->post('telp')."',
                        `aktif` = '".$this->input->post('aktif')."'
                        WHERE
                        `id_supplier` = '".$this->input->post('id_supplier')."' ";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }
}	  
?>