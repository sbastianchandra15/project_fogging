<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_model extends CI_Model
{
	function get_data(){
        $sql =  'SELECT  * FROM customer order by nama DESC ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_form(){
        $no_ktp             = $this->input->post('no_ktp');
        $nama               = $this->input->post('nama');
        $alamat             = $this->input->post('alamat');
        $telp               = $this->input->post('telp');
        $tgl_lahir          = $this->input->post('tgl_lahir');
        $tgl_register       = dbnow();
        $email              = $this->input->post('email');
        $username           = $this->input->post('username');
        $password           = md5($this->input->post('password'));

        $save               = $this->db->query('INSERT INTO `customer` (`no_ktp`,`nama`,`alamat`,`telp`,`tgl_lahir`,`tgl_register`,
                                                `email`,`password`,`username`) VALUES ("'.$no_ktp.'","'.$nama.'","'.$alamat.'","'.$telp.'",
                                                "'.$tgl_lahir.'","'.$tgl_register.'","'.$email.'","'.$password.'","'.$username.'")');

        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        return $this->db->query("SELECT * FROM customer Where no_ktp='".$id."'")->row();
    }

    function act_edit(){
        $sql = "UPDATE `customer` 
                    SET
                    `no_ktp` = '".$this->input->post('no_ktp')."',
                    `nama` = '".$this->input->post('nama')."',
                    `alamat` = '".$this->input->post('alamat')."',
                    `telp` = '".$this->input->post('telp')."',
                    `tgl_lahir` = '".$this->input->post('tgl_lahir')."',
                    `email` = '".$this->input->post('email')."',
                    `password` = '".md5($this->input->post('password'))."',
                    `username` = '".$this->input->post('username')."'
                    WHERE
                    `no_ktp` = '".$this->input->post('no_ktp_old')."'";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function act_delete($no_ktp){
        $sql = "DELETE FROM customer WHERE no_ktp='".$no_ktp."'";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    
}	  
?>