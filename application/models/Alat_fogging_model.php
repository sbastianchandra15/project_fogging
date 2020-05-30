<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alat_fogging_model extends CI_Model
{
	function get_data(){
        $sql =  'SELECT * FROM alat_fogging a left join kategori_alat b on a.id_kat=b.id_kat order by a.id_alat DESC ';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_form(){
        $nama               = $this->input->post('nama');
        $id_kat             = $this->input->post('id_kat');
        $no_seri            = $this->input->post('no_seri');
        $tgl_beli           = $this->input->post('tgl_beli');

        $save               = $this->db->query('INSERT INTO `alat_fogging` (`id_kat`,`nama`,`no_seri`,`tgl_beli`) VALUES 
                                ("'.$id_kat.'", "'.$nama.'", "'.$no_seri.'", "'.$tgl_beli.'")');

        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function detail($id){
        return $this->db->query("SELECT * FROM alat_fogging Where id_alat='".$id."'")->row();
    }

    function act_edit(){
        $sql = "UPDATE `alat_fogging` 
                    SET
                    `id_kat` = '".$this->input->post('id_kat')."', 
                    `nama` = '".$this->input->post('nama')."', 
                    `no_seri` = '".$this->input->post('no_seri')."', 
                    `tgl_beli` = '".$this->input->post('tgl_beli')."' 
                    WHERE
                    `id_alat` = '".$this->input->post('id_alat')."'";

        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    function act_delete($id){
        $sql = "DELETE FROM alat_fogging WHERE id_alat='".$id."'";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }

    
}	  
?>