<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	function get_data(){
        $sql =  'SELECT  * FROM admin order by id_user DESC ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_form(){
        $username           = $this->input->post('username');
        $password           = md5($this->input->post('password'));

        $save               = $this->db->query('INSERT INTO `admin` (`username`, `password`) VALUES ("'.$username.'", "'.$password.'")');

        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        return $this->db->query("SELECT * FROM admin Where id_user='".$id."'")->row();
    }

    function act_edit(){
        $sql = "UPDATE `admin` 
                    SET
                    `username` = '".$this->input->post('username')."', 
                    `password` = '".md5($this->input->post('password'))."'
                    WHERE
                    `id_user` = '".$this->input->post('id_user')."'";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function act_delete($id){
        $sql = "DELETE FROM admin WHERE id_user='".$id."'";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    
}	  
?>