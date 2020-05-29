<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{
	function get_user($usr,$pwd)
    {
        $sql =' SELECT * FROM `admin` '.
              ' WHERE username = "'.$usr.'"'.
              ' AND password = "'.md5($pwd).'"  ';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function detail_user($usr,$pwd){
    	$query = $this->db->query("SELECT * FROM `admin` 
                                            WHERE username='$usr' AND password='".md5($pwd)."'")->row();
            	
        return $query;
    }

    function all_user(){
    	return $this->db->get('user')->result();
    }

    function user_all(){
        $sql =  'SELECT   `id`, `nip`, `nrk`, `nama`, `jabatan`, `kelamin`,  `hak_akses` FROM `user` ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_delete($id){
        $sql = "UPDATE `user` SET `aktif` = '0'
                WHERE `id` = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function act_form(){
        $role = ($this->input->post('hak_akses')==1)? 'Super Admin' : 'Admin Gudang';
        $sql = "INSERT INTO user 
        (nip,nrk,nama,jabatan,kelamin,username,password,hak_akses,aktif,role)VALUES
        ('".$this->input->post('nip')."','".$this->input->post('nrk')."','".$this->input->post('nama')."','".$this->input->post('alamat')."','".$this->input->post('kelamin')."','".$this->input->post('username')."', '".md5($this->input->post('password'))."','".$this->input->post('hak_akses')."','".$this->input->post('aktif')."','".$role."')";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function data_user($id){
        $query = $this->db->query("SELECT   id,nip,nrk,nama,jabatan,kelamin,username,`password`,hak_akses,aktif 
                                    FROM `user` WHERE id='".$id."'")->row();
        return $query;
    }

    function act_edit(){
        $role = ($this->input->post('hak_akses')==1)? 'Super Admin' : 'Admin Gudang';
        $sql = "UPDATE `user` SET 
            nip = '".$this->input->post('nip')."', 
            nrk = '".$this->input->post('nrk')."', 
            nama = '".$this->input->post('nama')."', 
            jabatan = '".$this->input->post('jabatan')."', 
            kelamin = '".$this->input->post('kelamin')."', 
            username = '".$this->input->post('username')."', 
            `password` = '".md5($this->input->post('password'))."', 
            hak_akses = '".$this->input->post('hak_akses')."', 
            aktif = '".$this->input->post('aktif')."', 
            role = '".$role."'
            WHERE id='".$this->input->post('id')."'";
        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
}	