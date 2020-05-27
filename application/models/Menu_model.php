<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	function get_menu($hak_akses)
    {
        $sql =  'SELECT a.id, a.id_submenu, a.nama, a.keypress, a.url FROM menu a, menu_akses b WHERE a.id_submenu=0 AND b.hak_akses="'.$hak_akses.'" 
                 AND a.id=b.menu_id';
        $query = $this->db->query($sql)->result();
        
        return $query;
    }

    function get_submenu(){
        $sql = 'SELECT a.id, a.id_submenu, a.nama, a.keypress, a.url FROM menu a, menu_akses b WHERE a.id_submenu<>0 AND b.hak_akses=1 
                AND a.id=b.menu_id';

        $query = $this->db->query($sql)->result();
        return $query;
    }

    function akses_menu($menu_detail){
        $sql = "SELECT a.nama, a.id, b.hak_akses FROM menu a, menu_akses b WHERE a.id=b.menu_id AND b.hak_akses='1' AND a.url='".$menu_detail."'";
        $query = $this->db->query($sql)->num_rows();
        return $query;
    }
}	  
?>