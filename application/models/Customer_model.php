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
        $type_ktp           = $this->input->post('type_ktp');
        $file_ktp           = $no_ktp.'.'.$type_ktp;
        $nama               = $this->input->post('nama');
        $alamat             = $this->input->post('alamat');
        $telp               = $this->input->post('telp');
        $tgl_lahir          = $this->input->post('tgl_lahir');
        $tgl_register       = dbnow();
        $email              = $this->input->post('email');
        $username           = $this->input->post('username');
        $password           = md5($this->input->post('password'));

        $save               = $this->db->query('INSERT INTO `customer` (`no_ktp`,`scan_ktp`,`nama`,`alamat`,`telp`,`tgl_lahir`,`tgl_register`,
                                                `email`,`password`,`username`) VALUES ("'.$no_ktp.'","'.$file_ktp.'","'.$nama.'","'.$alamat.'","'.$telp.'",
                                                "'.$tgl_lahir.'","'.$tgl_register.'","'.$email.'","'.$password.'","'.$username.'")');

        if ($save === false){
            return "ERROR INSERTT";
        }else{
            return $save; 
        }

    }

    function detail($id){
        return $this->db->query("SELECT * FROM customer Where no_ktp='".$id."'")->row();
    }

    function act_edit(){
        $no_ktp             = $this->input->post('no_ktp');
        $type_ktp           = $this->input->post('type_ktp');
        $file_ktp           = $no_ktp.'.'.$type_ktp;

        $sql = "UPDATE `customer` 
                    SET
                    `no_ktp` = '".$this->input->post('no_ktp')."',
                    `scan_ktp` = '".$file_ktp."',
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

    function get_user($usr,$pwd)
    {
        $sql =' SELECT * FROM `customer` '.
              ' WHERE username = "'.$usr.'"'.
              ' AND password = "'.md5($pwd).'"  ';
              
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function detail_user($usr,$pwd){
        $query = $this->db->query("SELECT * FROM `customer` 
                                            WHERE username='$usr' AND password='".md5($pwd)."'")->row();
                
        return $query;
    }

    
}	  
?>