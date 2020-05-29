<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Toko_model extends CI_Model
{
	function get_toko()
    {
        $sql =  "SELECT     `id_toko`, `kode_toko`, `nama`, `alamat`, `telp`, `aktif` FROM `toko` WHERE aktif='1'";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_delete($id){
        $sql = "UPDATE `toko` SET `aktif` = '0' WHERE `id_toko` = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }


    function act_form(){
        $sql = "INSERT INTO `toko` 
                (`kode_toko`, `nama`, `alamat`, `telp`, `aktif`)VALUES
                ( '".$this->input->post('kd_toko')."', '".$this->input->post('nama_toko')."', '".$this->input->post('alamat')."', '".$this->input->post('telp')."', '".$this->input->post('aktif')."')";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        $sql = "SELECT  `id_toko`, `kode_toko`, `nama`, `alamat`, `telp`, `aktif` FROM `toko` 
                WHERE id_toko='".$id."'";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function act_edit(){
        $sql = "UPDATE `toko` SET
                        `kode_toko` = '".$this->input->post('kd_toko')."',
                        `nama` = '".$this->input->post('nama_toko')."',
                        `alamat` = '".$this->input->post('alamat')."',
                        `telp` = '".$this->input->post('telp')."',
                        `aktif` = '".$this->input->post('aktif')."'
                        WHERE
                        `id_toko` = '".$this->input->post('id_toko')."' ";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }
}	  
?>