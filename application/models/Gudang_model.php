<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gudang_model extends CI_Model
{
	function get_gudang()
    {
        $sql =  "SELECT id_gudang, nama, alamat, aktif, telp FROM gudang WHERE aktif='1'";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_delete($id){
        $sql = "UPDATE `gudang` SET `aktif` = '0' WHERE `id_gudang` = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }


    function act_form(){
        $sql = "INSERT INTO gudang (nama, alamat, telp, aktif)VALUES('".$this->input->post('nama')."', '".$this->input->post('alamat')."', '".$this->input->post('telp')."', '".$this->input->post('aktif')."')";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        $sql = "SELECT id_gudang,nama,alamat,telp,aktif FROM gudang WHERE id_gudang='".$id."'";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function act_edit(){
        $sql = "UPDATE gudang 
                    SET
                    nama = '".$this->input->post('nama')."', 
                    alamat = '".$this->input->post('alamat')."', 
                    telp = '".$this->input->post('telp')."', 
                    aktif = '".$this->input->post('aktif')."'
                    WHERE
                    id_gudang = '".$this->input->post('id_gudang')."'";
                    
        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }
}	  
?>