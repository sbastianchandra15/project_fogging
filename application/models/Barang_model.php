<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_model extends CI_Model
{
	function get_barang(){
        $sql =  'SELECT     a.`id_barang`, a.`kd_barang`, a.`nama_barang`, a.`saldo`, a.`kategori` FROM `barang` a WHERE a.aktif=1 ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function get_barang_jadi(){
        $sql =  'SELECT     a.`id_barang`, a.`kd_barang`, a.`nama_barang`, a.`saldo`, a.`kategori` FROM `barang` a WHERE a.aktif=1 AND a.kategori="Jadi" ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function get_barang_mentah(){
        $sql =  'SELECT     a.`id_barang`, a.`kd_barang`, a.`nama_barang`, a.`saldo`, a.`kategori` FROM `barang` a WHERE a.aktif=1 AND a.kategori="Mentah" ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_delete($id){
        $sql = "UPDATE `barang` SET `aktif` = '0'
                WHERE `id_barang` = '".$id."'";
        $query = $this->db->query($sql);
        return $query;

    }

    function act_form(){
        $sql = "INSERT INTO `barang` 
                (`kd_barang`, `nama_barang`, `aktif`, `saldo`, `kategori`) VALUES
                ('".$this->input->post('kd_barang')."', '". $this->input->post('nama_barang')."', '". $this->input->post('aktif')."', '". $this->input->post('saldo')."', '". $this->input->post('kategori')."')";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        $sql = "SELECT  `id_barang`, `kd_barang`, `nama_barang`, `aktif`, `saldo`, `kategori` FROM `barang` WHERE id_barang='".$id."'";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function act_edit(){
        $sql = "UPDATE `barang` 
                    SET
                    `kd_barang` = '".$this->input->post('kd_barang')."', 
                    `nama_barang` = '".$this->input->post('nama_barang')."', 
                    `kategori` = '". $this->input->post('kategori')."',
                    `aktif` = '".$this->input->post('aktif')."'
                    WHERE
                    `id_barang` = '".$this->input->post('id_barang')."'";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }
}	  
?>