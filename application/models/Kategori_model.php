<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
	function get_data(){
        $sql =  'SELECT  * FROM kategori_alat order by id_kat DESC ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_form(){
        $kategori           = $this->input->post('kategori');

        $save               = $this->db->query('INSERT INTO `kategori_alat` (`kategori`) VALUES ("'.$kategori.'")');

        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        return $this->db->query("SELECT * FROM kategori_alat Where id_kat='".$id."'")->row();
    }

    function act_edit(){
        $sql = "UPDATE `kategori_alat` 
                    SET
                    `kategori` = '".$this->input->post('kategori')."'
                    WHERE
                    `id_kat` = '".$this->input->post('id_kat')."'";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function act_delete($id){
        $sql = "DELETE FROM kategori_alat WHERE id_kat='".$id."'";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    
}	  
?>