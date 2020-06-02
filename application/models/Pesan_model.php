<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pesan_model extends CI_Model
{
	function get_pesan_header()
    {
        $sql =  'SELECT a.no_pesan,a.tgl,a.no_ktp,b.nama,b.scan_ktp,a.keterangan FROM pesan_header a 
                LEFT JOIN customer b on a.no_ktp=b.no_ktp
        ORDER BY a.no_pesan DESC';

        $query = $this->db->query($sql)->result();
        return $query;
    }

    function get_transaksi_keluar()
    {
        $sql =  'SELECT a.id_trans, a.kd_trans, a.tgl, a.keterangan, a.jns_trans, a.status, c.nama nama_gudang, a.id_toko, d.nama nama_toko
                    FROM trn_barang_header a LEFT JOIN gudang c ON a.gd_pengambilan=c.id_gudang LEFT JOIN toko d on a.id_toko=d.id_toko WHERE a.jns_trans=2 order by a.tgl desc, a.kd_trans desc';
        $query = $this->db->query($sql)->result();
        return $query;
    }


    function act_delete_transaksi_masuk($id)
    {
        $saldo_akhir = 0;

        // $sql =  "UPDATE trn_barang_header SET 
        //             `status` = 'VO'
        //             WHERE id_trans='".$id."'";        
        
        $sql_header     = "SELECT `kd_trans` FROM `trn_barang_header` WHERE id_trans='".$id."'";
        $query_header   = $this->db->query($sql_header)->row();

        $sql_stok = "DELETE FROM stok WHERE no_dokumen = '".$query_header->kd_trans."'";
        $query_stok = $this->db->query($sql_stok);

        $sql_detail = "SELECT `id_barang`, `qty`, `aktif` FROM `trn_barang_detail` WHERE id_trans='".$id."'";
        $query_detail = $this->db->query($sql_detail)->result();

        foreach ($query_detail as $key => $value) {
            $sql_barang = "SELECT `id_barang`, `saldo` FROM `barang` WHERE id_barang='".$value->id_barang."'";
            $query_barang = $this->db->query($sql_barang)->row();

            $saldo_akhir    = $query_barang->saldo-$value->qty;

            $sql_barang_update = "UPDATE `barang` SET saldo = '".$saldo_akhir."' WHERE id_barang='".$value->id_barang."'";
            $query_barang_update = $this->db->query($sql_barang_update);
        }

        $sql_1      = "DELETE FROM `trn_barang_header` WHERE `id_trans` = '".$id."'";
        $query_1    = $this->db->query($sql_1);
        $sql_2      = "DELETE FROM `trn_barang_detail` WHERE `id_trans` = '".$id."'";
        $query_2    = $this->db->query($sql_2);
    }

    function act_delete_transaksi_keluar($id)
    {
        $saldo_akhir = 0;

        $query_detail = $this->get_transaksi_masuk_detail($id); 

        // foreach ($query_detail as $key => $value) {
        //     $id_barang      = $value->id_barang;
        //     $qty            = $value->qty;

        //     $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();
        //     $saldo_akhir= $cek_saldo->saldo+$qty;
        //     $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");
        // }
        
        $sql_header     = "SELECT `kd_trans` FROM `trn_barang_header` WHERE id_trans='".$id."'";
        $query_header   = $this->db->query($sql_header)->row();

        $sql_stok = "DELETE FROM stok WHERE no_dokumen = '".$query_header->kd_trans."'";
        $query_stok = $this->db->query($sql_stok);


        $sql_detail = "SELECT `id_barang`, `qty`, `aktif` FROM `trn_barang_detail` WHERE id_trans='".$id."'";
        $query_detail = $this->db->query($sql_detail)->result();

        foreach ($query_detail as $key => $value) {
            $sql_barang = "SELECT `id_barang`, `saldo` FROM `barang` WHERE id_barang='".$value->id_barang."'";
            $query_barang = $this->db->query($sql_barang)->row();

            $saldo_akhir    = $query_barang->saldo+$value->qty;

            $sql_barang_update = "UPDATE `barang` SET saldo = '".$saldo_akhir."' WHERE id_barang='".$value->id_barang."'";
            $query_barang_update = $this->db->query($sql_barang_update);
        }

        $sql_1      = "DELETE FROM `trn_barang_header` WHERE `id_trans` = '".$id."'";
        $query_1    = $this->db->query($sql_1);
        $sql_2      = "DELETE FROM `trn_barang_detail` WHERE `id_trans` = '".$id."'";
        $query_2    = $this->db->query($sql_2);
    }

    function save_transaksi_masuk(){
        $new_ni = $this->session->userdata('new_ni');
        $this->db->trans_begin();

        $tgl_pot        = substr($new_ni['tanggal'],8,2);
        $bulan          = substr($new_ni['tanggal'],5,2);
        $tahun          = substr($new_ni['tanggal'],0,4);

        $periode= $tahun.$bulan;

        $query_no_urut  = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(kd_trans,12,3))+1,3,'0'),'001') nomor_dok,
                            MAX(id_trans)+1 id_trans FROM `trn_barang_header` WHERE DATE_FORMAT(tgl, '%Y%m')='".$periode."' 
                            AND jns_trans='1'")->row();
        $query_id_trans = $this->db->query("SELECT IFNULL(MAX(id_trans)+1,1) id_trans FROM trn_barang_header")->row();


        $kd_trans       = 'TBM-'.$bulan.$tahun.$query_no_urut->nomor_dok;
        $id_trans       = $query_id_trans->id_trans;
        $tgl            = $new_ni['tanggal'];
        $keterangan     = $new_ni['keterangan'];
        $gd_tujuan      = $new_ni['gd_tujuan'];
        //$id_supplier    = $new_ni['id_supplier'];
        $tgl_input      = dbnow();
        $user_input     = $this->session->userdata('id');

        $query_insert_header  = "INSERT INTO `trn_barang_header` 
            (`id_trans`,`kd_trans`,`tgl`,`gd_tujuan`,`keterangan`,`jns_trans`,`status`)VALUES
           ('".$id_trans."','".$kd_trans."','".$tgl."','".$gd_tujuan."','".$keterangan."','1','CO')";

        $header = $this->db->query($query_insert_header);

        $items = $new_ni['items'];
        //  test($items,1);
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();

            $saldo_akhir= $cek_saldo->saldo+$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");

            $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_tujuan."', '".$id_barang."', '".$qty."', 'IN', '1', '".dbnow()."')");

            $detail = $this->db->query($query_insert_detail);
        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function get_transaksi_masuk_header($id){
        $sql  = $this->db->query("SELECT a.id_trans, a.kd_trans, a.tgl, a.gd_tujuan, a.gd_pengambilan, a.id_toko, a.keterangan, a.jns_trans, a.status, 
                                    c.nama nama_gudang, d.nama nama_toko
                                    FROM trn_barang_header a 
                                    LEFT JOIN gudang c ON a.gd_tujuan=c.id_gudang 
                                    LEFT JOIN toko d ON a.id_toko=d.id_toko 
                                   
                                    WHERE a.id_trans='".$id."' ")->row();

        return $sql;
    }

    function get_transaksi_masuk_detail($id){
        $sql  = $this->db->query("SELECT a.id_barang, b.kd_barang, b.nama_barang, a.qty  FROM trn_barang_detail a, barang b WHERE 
                                    a.id_barang=b.id_barang AND id_trans='".$id."'")->result();
        return $sql;
    }

    function get_transaksi_keluar_header($id){
        $sql  = $this->db->query("SELECT a.id_trans, a.kd_trans, a.tgl, a.gd_tujuan, a.gd_pengambilan,b.nama, a.keterangan, a.jns_trans, a.status, d.nama nama_gudang_pengambilan, e.nama gudang_tujuan, b.nama nama_toko
                                    FROM trn_barang_header a 
                                    LEFT JOIN toko b ON a.id_toko=b.id_toko 
                                    LEFT JOIN gudang d ON a.gd_pengambilan=d.id_gudang 
                                    LEFT JOIN gudang e ON a.gd_tujuan=e.id_gudang WHERE a.id_trans='".$id."' ")->row();

        return $sql;
    }

    function get_transaksi_mutasi_header($id){
        $sql  = $this->db->query("SELECT a.id_trans, a.kd_trans, a.tgl, a.gd_tujuan, a.gd_pengambilan, a.keterangan, a.jns_trans, a.status, d.nama nama_gudang_pengambilan
                                    FROM trn_barang_header a 
                                    LEFT JOIN gudang d ON a.gd_pengambilan=d.id_gudang WHERE a.id_trans='".$id."' ")->row();

        return $sql;
    }

    function edit_transaksi_masuk(){
        $new_ni = $this->session->userdata('new_ni');

        $this->db->trans_begin();

        $tgl            = $new_ni['tanggal'];
        $keterangan     = $new_ni['keterangan'];
        $id_trans       = $new_ni['id_trans'];
        $kd_trans       = $new_ni['kd_trans'];
        $gd_tujuan      = $new_ni['gd_tujuan'];
        //$id_supplier    = $new_ni['id_supplier'];
        $tgl_update      = dbnow();
        $user_update     = $this->session->userdata('id');

        $query_insert_header  = "UPDATE `trn_barang_header` SET 
                                tgl = '".$tgl."', gd_tujuan = '".$gd_tujuan."', keterangan = '".$keterangan."' WHERE id_trans = '".$id_trans."'";

        $header = $this->db->query($query_insert_header);

        $sql_header     = "SELECT `kd_trans` FROM `trn_barang_header` WHERE id_trans='".$id_trans."'";
        $query_header   = $this->db->query($sql_header)->row();

        $delete_stok = "DELETE FROM `stok` WHERE `no_dokumen` = '".$query_header->kd_trans."'";
        $query_stok = $this->db->query($delete_stok);

        $query_detail = $this->get_transaksi_masuk_detail($id_trans); 

        foreach ($query_detail as $key => $value) {
            $id_barang      = $value->id_barang;
            $qty            = $value->qty;

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();
            $saldo_akhir= $cek_saldo->saldo-$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");
        }

        $delete = $this->db->query("DELETE FROM trn_barang_detail WHERE id_trans = '".$id_trans."'");

        $items = $new_ni['items'];
        //  test($items,1);
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();

            $saldo_akhir= $cek_saldo->saldo+$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");

            $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_tujuan."', '".$id_barang."', '".$qty."', 'IN', '1', '".dbnow()."')");

            $detail = $this->db->query($query_insert_detail);
        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function save_transaksi_keluar(){
        $new_tbk = $this->session->userdata('new_tbk');

        $this->db->trans_begin();

        $tgl_pot        = substr($new_tbk['tanggal'],8,2);
        $bulan          = substr($new_tbk['tanggal'],5,2);
        $tahun          = substr($new_tbk['tanggal'],0,4);

        $periode= $tahun.$bulan;

        $query_no_urut  = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(kd_trans,12,3))+1,3,'0'),'001') nomor_dok,
                            MAX(id_trans)+1 id_trans FROM `trn_barang_header` WHERE DATE_FORMAT(tgl, '%Y%m')='".$periode."' 
                            AND jns_trans='2'")->row();
        $query_id_trans = $this->db->query("SELECT IFNULL(MAX(id_trans)+1,1) id_trans FROM trn_barang_header")->row();


        $kd_trans       = 'TBK-'.$bulan.$tahun.$query_no_urut->nomor_dok;
        $id_trans       = $query_id_trans->id_trans;
        $tgl            = $new_tbk['tanggal'];
        $keterangan     = $new_tbk['keterangan'];
        $gd_pengambilan = $new_tbk['gd_pengambilan'];
        $id_toko        = $new_tbk['id_toko'];
        $tgl_input      = dbnow();
        $user_input     = $this->session->userdata('id');

        $query_insert_header  = "INSERT INTO `trn_barang_header` 
            (`id_trans`,`kd_trans`,`tgl`,`gd_pengambilan`,`keterangan`,`id_toko`,`jns_trans`,`status`)VALUES
           ('".$id_trans."','".$kd_trans."','".$tgl."','".$gd_pengambilan."','".$keterangan."','".$id_toko."','2','CO')";

        $header = $this->db->query($query_insert_header);

        $items = $new_tbk['items'];
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT id_gudang, id_barang, `status`, 
                        (SELECT IFNULL(SUM(qty),0) FROM stok WHERE aktif=1 AND id_barang=$id_barang AND id_gudang=$gd_pengambilan AND `status`='IN') - 
                        (SELECT IFNULL(SUM(qty),0) FROM stok WHERE aktif=1 AND id_barang=$id_barang AND id_gudang=$gd_pengambilan AND `status`='OUT') 
                        last_stok
                        FROM stok
                        WHERE aktif=1 AND id_barang=$id_barang AND id_gudang=$gd_pengambilan LIMIT 1")->row();
            
            $saldo_akhir= $cek_saldo->last_stok-$qty;

            if($saldo_akhir<=0){
                $this->db->trans_rollback();
                return "STOK";
            }else{
                $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

                $detail = $this->db->query($query_insert_detail);

                $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                    (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                    ('".$kd_trans."', '".$tgl."', '".$gd_pengambilan."', '".$id_barang."', '".$qty."', 'OUT', '1', '".dbnow()."')");

                $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");
            }

        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function edit_transaksi_keluar(){
        $new_tbk = $this->session->userdata('new_tbk');
        //test($new_tbk,1);
        $this->db->trans_begin();

        $tgl            = $new_tbk['tanggal'];
        $keterangan     = $new_tbk['keterangan'];
        $id_trans       = $new_tbk['id_trans'];
        $kd_trans       = $new_tbk['kd_trans'];
        $gd_pengambilan = $new_tbk['gd_pengambilan'];
        $id_toko    = $new_tbk['id_toko'];
        $tgl_update      = dbnow();
        $user_update     = $this->session->userdata('id');

        $query_insert_header  = "UPDATE `trn_barang_header` SET gd_pengambilan = '".$gd_pengambilan."', id_toko = '".$id_toko."',
                                tgl = '".$tgl."', keterangan = '".$keterangan."'  WHERE id_trans = '".$id_trans."'";

        $header = $this->db->query($query_insert_header);

        $sql_header     = "SELECT `kd_trans` FROM `trn_barang_header` WHERE id_trans='".$id_trans."'";
        //test($sql_header,1);
        $query_header   = $this->db->query($sql_header)->row();

        $delete_stok = "DELETE FROM `stok` WHERE `no_dokumen` = '".$query_header->kd_trans."'";
        $query_stok = $this->db->query($delete_stok);

        $query_detail = $this->get_transaksi_masuk_detail($id_trans); 

        foreach ($query_detail as $key => $value) {
            $id_barang      = $value->id_barang;
            $qty            = $value->qty;

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();
            $saldo_akhir= $cek_saldo->saldo+$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");
        }

        $delete = $this->db->query("DELETE FROM trn_barang_detail WHERE id_trans = '".$id_trans."'");

        $items = $new_tbk['items'];
        //  test($items,1);
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();

            $saldo_akhir= $cek_saldo->saldo-$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");

            $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

            $detail = $this->db->query($query_insert_detail);

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_pengambilan."', '".$id_barang."', '".$qty."', 'OUT', '1', '".dbnow()."')");
        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function get_stok($periode,$idbarang){
        $sql =  "SELECT a1.kd_barang, a1.nama_barang, a1.id_barang,
                (SELECT IFNULL(SUM(b.qty),0) FROM trn_barang_header a, trn_barang_detail b WHERE a.id_trans=b.id_trans AND a.jns_trans='1'
                AND a.status='CO' AND DATE_FORMAT(a.tgl, '%Y-%m')='".$periode."' AND b.id_barang=a1.id_barang) trn_masuk,
                (SELECT IFNULL(SUM(b.qty),0) FROM trn_barang_header a, trn_barang_detail b WHERE a.id_trans=b.id_trans AND a.jns_trans='2'
                AND a.status='CO' AND DATE_FORMAT(a.tgl, '%Y-%m')='".$periode."' AND b.id_barang=a1.id_barang) trn_keluar,
                ((SELECT IFNULL(SUM(b.qty),0) FROM trn_barang_header a, trn_barang_detail b WHERE a.id_trans=b.id_trans AND 
                a.jns_trans='1' AND a.status='CO' AND DATE_FORMAT(a.tgl, '%Y-%m')='".$periode."' AND b.id_barang=a1.id_barang)-
                (SELECT IFNULL(SUM(b.qty),0) FROM trn_barang_header a, trn_barang_detail b WHERE a.id_trans=b.id_trans AND a.jns_trans='2'
                AND a.status='CO' AND DATE_FORMAT(a.tgl, '%Y-%m')='".$periode."' AND b.id_barang=a1.id_barang)) AS saldo_awal
                FROM barang a1 WHERE a1.aktif='1' ";
        if($idbarang!=0){
        $sql .= " AND a1.id_barang='".$idbarang."'";
        }
        
        //test($sql,1);
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function detail_report($id, $periode){
        $sql =  "SELECT a.kd_trans, a.tgl, a.keterangan, b.id_barang, b.qty, a.jns_trans
                    FROM trn_barang_header a, trn_barang_detail b
                    WHERE a.id_trans=b.id_trans AND a.status='CO' AND b.id_barang='".$id."'
                    AND DATE_FORMAT(a.tgl, '%Y-%m')='".$periode."' order by a.jns_trans";
                    //test($sql,0);
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function detail_report_num_rows($id, $periode){
        $sql =  "SELECT a.kd_trans, a.tgl, a.keterangan, b.id_barang, b.qty, a.jns_trans
                    FROM trn_barang_header a, trn_barang_detail b
                    WHERE a.id_trans=b.id_trans AND a.status='CO' AND b.id_barang='".$id."'
                    AND DATE_FORMAT(a.tgl, '%Y-%m')='".$periode."' order by a.jns_trans";
        $query = $this->db->query($sql)->num_rows();
        return $query;
    }

    function total_masuk($id, $periode){
        $sql =  "SELECT SUM(qty) as qty FROM trn_barang_detail b, trn_barang_header a1 
                    WHERE a1.id_trans=b.id_trans AND b.id_barang='".$id."' 
                    AND a1.jns_trans=1 AND a1.status='CO' AND DATE_FORMAT(a1.tgl, '%Y-%m')='".$periode."'";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function total_keluar($id, $periode){
        $sql =  "SELECT SUM(qty) as qty FROM trn_barang_detail b, trn_barang_header a1 
                    WHERE a1.id_trans=b.id_trans AND b.id_barang='".$id."' 
                    AND a1.jns_trans=2 AND a1.status='CO' AND DATE_FORMAT(a1.tgl, '%Y-%m')='".$periode."'";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function get_transaksi_retur_keluar()
    {
        $sql =  'SELECT a.id_trans, a.kd_trans, a.tgl, a.keterangan, a.jns_trans, a.status
                    FROM trn_barang_header a WHERE a.jns_trans=3 order by a.tgl desc , a.kd_trans desc';
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function save_transaksi_retur_keluar(){
        $new_ni = $this->session->userdata('new_ni');
        // test($new_ni,1);
        $this->db->trans_begin();

        $tgl_pot        = substr($new_ni['tanggal'],8,2);
        $bulan          = substr($new_ni['tanggal'],5,2);
        $tahun          = substr($new_ni['tanggal'],0,4);

        $periode= $tahun.$bulan;

        $query_no_urut  = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(kd_trans,12,3))+1,3,'0'),'001') nomor_dok,
                            MAX(id_trans)+1 id_trans FROM `trn_barang_header` WHERE DATE_FORMAT(tgl, '%Y%m')='".$periode."' 
                            AND jns_trans='3'")->row();
        $query_id_trans = $this->db->query("SELECT IFNULL(MAX(id_trans)+1,1) id_trans FROM trn_barang_header")->row();


        $kd_trans       = 'TRK-'.$bulan.$tahun.$query_no_urut->nomor_dok;
        $id_trans       = $query_id_trans->id_trans;
        $tgl            = $new_ni['tanggal'];
        //$id_supplier    = $new_ni['id_supplier'];
        $keterangan     = $new_ni['keterangan'];
        $gd_tujuan      = $new_ni['gd_tujuan'];
        $id_toko        = $new_ni['id_toko'];
        $tgl_input      = dbnow();
        $user_input     = $this->session->userdata('id');

        $query_insert_header  = "INSERT INTO `trn_barang_header` 
            (`id_trans`,`kd_trans`,`tgl`,`id_toko`,`gd_tujuan`,`keterangan`,`jns_trans`,`status`)VALUES
           ('".$id_trans."','".$kd_trans."','".$tgl."','".$id_toko."','".$gd_tujuan."','".$keterangan."','3','CO')";

        $header = $this->db->query($query_insert_header);

        $items = $new_ni['items'];
        //  test($items,1);
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();

            $saldo_akhir= $cek_saldo->saldo+$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");

            $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

            $detail = $this->db->query($query_insert_detail);

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_tujuan."', '".$id_barang."', '".$qty."', 'IN', '1', '".dbnow()."')");
        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function act_delete_transaksi_retur_keluar($id)
    {
        $saldo_akhir = 0;
        // $sql =  "UPDATE trn_barang_header SET 
        //             `status` = 'VO'
        //             WHERE id_trans='".$id."'";
        // $query = $this->db->query($sql);
        
        $sql_header     = "SELECT `kd_trans` FROM `trn_barang_header` WHERE id_trans='".$id."'";
        $query_header   = $this->db->query($sql_header)->row();

        // $sql_stok = "UPDATE `stok` SET `aktif` = '0', `tgl_update` = '".dbnow()."' WHERE `no_dokumen` = '".$query_header->kd_trans."'";
        // $query_stok = $this->db->query($sql_stok);

        $sql_stok = "DELETE FROM stok WHERE no_dokumen = '".$query_header->kd_trans."'";
        $query_stok = $this->db->query($sql_stok);

        $sql_detail = "SELECT `id_barang`, `qty`, `aktif` FROM `trn_barang_detail` WHERE id_trans='".$id."'";
        $query_detail = $this->db->query($sql_detail)->result();

        foreach ($query_detail as $key => $value) {
            $sql_barang = "SELECT `id_barang`, `saldo` FROM `barang` WHERE id_barang='".$value->id_barang."'";
            $query_barang = $this->db->query($sql_barang)->row();

            $saldo_akhir    = $query_barang->saldo-$value->qty;

            $sql_barang_update = "UPDATE `barang` SET saldo = '".$saldo_akhir."' WHERE id_barang='".$value->id_barang."'";
            $query_barang_update = $this->db->query($sql_barang_update);
        }

        $sql_1      = "DELETE FROM `trn_barang_header` WHERE `id_trans` = '".$id."'";
        $query_1    = $this->db->query($sql_1);
        $sql_2      = "DELETE FROM `trn_barang_detail` WHERE `id_trans` = '".$id."'";
        $query_2    = $this->db->query($sql_2);
    }

    function edit_transaksi_retur_keluar(){
        $new_ni = $this->session->userdata('new_ni');

        $this->db->trans_begin();

        $tgl            = $new_ni['tanggal'];
        $id_toko    = $new_ni['id_toko'];
        $keterangan     = $new_ni['keterangan'];
        $id_trans       = $new_ni['id_trans'];
        $kd_trans       = $new_ni['kd_trans'];
        $gd_tujuan      = $new_ni['gd_tujuan'];
        $tgl_update      = dbnow();
        $user_update     = $this->session->userdata('id');

        $query_insert_header  = "UPDATE `trn_barang_header` SET 
                                tgl = '".$tgl."', id_toko = '".$id_toko."', gd_tujuan = '".$gd_tujuan."', keterangan = '".$keterangan."' WHERE id_trans = '".$id_trans."'";

        $header = $this->db->query($query_insert_header);

        $sql_header     = "SELECT `kd_trans` FROM `trn_barang_header` WHERE id_trans='".$id_trans."'";
        $query_header   = $this->db->query($sql_header)->row();

        $delete_stok = "DELETE FROM `stok` WHERE `no_dokumen` = '".$query_header->kd_trans."'";
        $query_stok = $this->db->query($delete_stok);

        $query_detail = $this->get_transaksi_masuk_detail($id_trans); 

        foreach ($query_detail as $key => $value) {
            $id_barang      = $value->id_barang;
            $qty            = $value->qty;

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();
            $saldo_akhir= $cek_saldo->saldo-$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");
        }

        $delete = $this->db->query("DELETE FROM trn_barang_detail WHERE id_trans = '".$id_trans."'");

        $items = $new_ni['items'];
        //  test($items,1);
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();

            $saldo_akhir= $cek_saldo->saldo+$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");

            $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

            $detail = $this->db->query($query_insert_detail);

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_tujuan."', '".$id_barang."', '".$qty."', 'IN', '1', '".dbnow()."')");
        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function get_transaksi_mutasi()
    {
        $sql =  'SELECT a.id_trans, a.kd_trans, a.tgl, a.keterangan, a.jns_trans, a.status, c.nama nama_gudang_tujuan, 
                d.nama nama_gudang_pengambilan FROM trn_barang_header a 
                LEFT JOIN gudang c ON a.gd_pengambilan=c.id_gudang 
                LEFT JOIN gudang d ON a.gd_tujuan=d.id_gudang
                WHERE a.jns_trans=4 ORDER BY a.tgl DESC, a.kd_trans DESC';

        $query = $this->db->query($sql)->result();
        return $query;
    }

    function save_transaksi_mutasi(){
        $new_tbm = $this->session->userdata('new_tbm');
        $this->db->trans_begin();

        $tgl_pot        = substr($new_tbm['tanggal'],8,2);
        $bulan          = substr($new_tbm['tanggal'],5,2);
        $tahun          = substr($new_tbm['tanggal'],0,4);

        $periode= $tahun.$bulan;

        $query_no_urut  = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(kd_trans,12,3))+1,3,'0'),'001') nomor_dok,
                            MAX(id_trans)+1 id_trans FROM `trn_barang_header` WHERE DATE_FORMAT(tgl, '%Y%m')='".$periode."' 
                            AND jns_trans='4'")->row();
        $query_id_trans = $this->db->query("SELECT IFNULL(MAX(id_trans)+1,1) id_trans FROM trn_barang_header")->row();


        $kd_trans       = 'TMB-'.$bulan.$tahun.$query_no_urut->nomor_dok;
        $id_trans       = $query_id_trans->id_trans;
        $tgl            = $new_tbm['tanggal'];
        $keterangan     = $new_tbm['keterangan'];
        $gd_pengambilan = $new_tbm['gd_pengambilan'];
        $gd_tujuan      = $new_tbm['gd_tujuan'];
        $tgl_input      = dbnow();
        $user_input     = $this->session->userdata('id');

        $query_insert_header = "INSERT INTO trn_barang_header 
                (id_trans,kd_trans,tgl,gd_tujuan,gd_pengambilan,keterangan,jns_trans,`status`)VALUES
                ('".$id_trans."','".$kd_trans."','".$tgl."','".$gd_tujuan."','".$gd_pengambilan."','".$keterangan."','4','CO')";

        $header = $this->db->query($query_insert_header);

        $items = $new_tbm['items'];
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();

            $saldo_akhir= $cek_saldo->saldo-$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");

            $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

            $detail = $this->db->query($query_insert_detail);

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_pengambilan."', '".$id_barang."', '".$qty."', 'OUT', '1', '".dbnow()."')");

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_tujuan."', '".$id_barang."', '".$qty."', 'IN', '1', '".dbnow()."')");
        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function edit_transaksi_mutasi(){
        $new_tbm = $this->session->userdata('new_tbm');
        //test($new_tbm,1);
        $this->db->trans_begin();

        $tgl            = $new_tbm['tanggal'];
        $keterangan     = $new_tbm['keterangan'];
        $id_trans       = $new_tbm['id_trans'];
        $kd_trans       = $new_tbm['kd_trans'];
        $gd_pengambilan = $new_tbm['gd_pengambilan'];
        $gd_tujuan      = $new_tbm['gd_tujuan'];
        $tgl_update      = dbnow();
        $user_update     = $this->session->userdata('id');

        $query_insert_header  = "UPDATE `trn_barang_header` SET gd_pengambilan = '".$gd_pengambilan."', gd_tujuan = '".$gd_tujuan."',
                                tgl = '".$tgl."', keterangan = '".$keterangan."' WHERE id_trans = '".$id_trans."'";

        $header = $this->db->query($query_insert_header);

        $sql_header     = "SELECT `kd_trans` FROM `trn_barang_header` WHERE id_trans='".$id_trans."'";
        $query_header   = $this->db->query($sql_header)->row();

        $delete_stok = "DELETE FROM `stok` WHERE `no_dokumen` = '".$query_header->kd_trans."'";
        $query_stok = $this->db->query($delete_stok);

        $query_detail = $this->get_transaksi_masuk_detail($id_trans); 

        foreach ($query_detail as $key => $value) {
            $id_barang      = $value->id_barang;
            $qty            = $value->qty;

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();
            $saldo_akhir= $cek_saldo->saldo+$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");
        }

        $delete = $this->db->query("DELETE FROM trn_barang_detail WHERE id_trans = '".$id_trans."'");

        $items = $new_tbm['items'];
        //  test($items,1);
        foreach ($items as $key => $value) { 
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT `saldo` FROM `barang` WHERE id_barang='".$id_barang."'")->row();

            $saldo_akhir= $cek_saldo->saldo-$qty;

            $query_update_barang = $this->db->query("UPDATE `barang` SET `saldo` = '$saldo_akhir' WHERE `id_barang` = '".$id_barang."'");

            $query_insert_detail = "INSERT INTO `trn_barang_detail` (`id_trans`, `id_barang`, `qty`)VALUES
                                    ('".$id_trans."', '".$id_barang."', '".$qty."')";

            $detail = $this->db->query($query_insert_detail);

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_tujuan."', '".$id_barang."', '".$qty."', 'IN', '1', '".dbnow()."')");

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_pengambilan."', '".$id_barang."', '".$qty."', 'OUT', '1', '".dbnow()."')");
        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function get_production()
    {
        $sql =  'SELECT a.id_produksi, a.no_produksi, a.id_gudang, a.tgl, a.id_barang, a.qty, a.status, b.nama, c.nama_barang 
                FROM produksi_header a 
                LEFT JOIN gudang b ON a.id_gudang=b.id_gudang
                LEFT JOIN barang c ON a.id_barang=c.id_barang
                ORDER BY a.tgl DESC';

        $query = $this->db->query($sql)->result();
        return $query;
    }

    function act_delete_transaksi_production($id)
    {
        $sql_header     = "SELECT `no_produksi` FROM `produksi_header` WHERE id_produksi='".$id."'";
        $query_header   = $this->db->query($sql_header)->row();

        $sql_stok = "UPDATE `stok` SET `aktif` = '0', `tgl_update` = '".dbnow()."' WHERE `no_dokumen` = '".$query_header->no_produksi."'";
        $query_stok = $this->db->query($sql_stok);

        $sql =  "UPDATE produksi_header SET `status`='VO' WHERE id_produksi='".$id."'";
        $query = $this->db->query($sql);
    }

    function save_production(){
        $new_prod = $this->session->userdata('new_prod');
        $this->db->trans_begin();

        $tgl_pot        = substr($new_prod['tanggal'],8,2);
        $bulan          = substr($new_prod['tanggal'],5,2);
        $tahun          = substr($new_prod['tanggal'],0,4);

        $periode= $tahun.$bulan;

        $query_no_urut  = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(no_produksi,12,3))+1,3,'0'),'001') nomor_dok,
                            MAX(id_produksi)+1 id_produksi FROM `produksi_header` WHERE DATE_FORMAT(tgl, '%Y%m')='".$periode."'")->row();
        $query_id_trans = $this->db->query("SELECT IFNULL(MAX(id_produksi)+1,1) id_produksi FROM produksi_header")->row();


        $kd_trans       = 'PDS-'.$bulan.$tahun.$query_no_urut->nomor_dok;
        $id_trans       = $query_id_trans->id_produksi;
        $tgl            = $new_prod['tanggal'];
        $gd_tujuan      = $new_prod['gd_tujuan'];
        $id_barang_jadi = $new_prod['id_barang_jadi'];
        $qty_jadi       = $new_prod['qty_jadi'];
        $tgl_input      = dbnow();
        $user_input     = $this->session->userdata('id');

        $query_insert_header  = "INSERT INTO produksi_header
        (id_produksi,no_produksi,id_gudang,tgl,id_barang,qty,`status`)VALUES
        ('".$id_trans."','".$kd_trans."','".$gd_tujuan."','".$tgl."','".$id_barang_jadi."','".$qty_jadi."','CO')";
        //test($query_insert_header,1);
        // $query_insert_header  = "INSERT INTO `trn_barang_header` 
        //     (`id_trans`,`kd_trans`,`tgl`,`gd_tujuan`,`keterangan`,`tgl_input`,`user_input`,`jns_trans`,`status`)VALUES
        //    ('".$id_trans."','".$kd_trans."','".$tgl."','".$gd_tujuan."','".$keterangan."','".$tgl_input."','".$user_input."','1','CO')";

        $header = $this->db->query($query_insert_header);

        $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$gd_tujuan."', '".$id_barang_jadi."', '".$qty_jadi."', 'IN', '1', '".dbnow()."')");

        $items = $new_prod['items'];
        foreach ($items as $key => $value) { 
            $id_gudang      = $value['id_gudang'];
            $id_barang      = $value['id_barang'];
            $qty            = $value['qty'];

            $cek_saldo  = $this->db->query("SELECT id_gudang, id_barang, `status`, 
                        (SELECT SUM(qty) FROM stok WHERE aktif=1 AND id_barang=$id_barang AND id_gudang=$gd_pengambilan AND `status`='IN') - 
                        (SELECT SUM(qty) FROM stok WHERE aktif=1 AND id_barang=$id_barang AND id_gudang=$gd_pengambilan AND `status`='OUT') 
                        last_stok
                        FROM stok
                        WHERE aktif=1 AND id_barang=$id_barang AND id_gudang=$gd_pengambilan")->row();
            
            $saldo_akhir= $cek_saldo->last_stok-$qty;

            if($saldo_akhir<=0){
                $this->db->trans_rollback();
                return "STOK";
            }else{

            $query_insert_detail = "INSERT INTO produksi_detail (id_produksi,id_gudang,id_barang,qty)
                VALUES('".$id_trans."','".$id_gudang."','".$id_barang."','".$qty."')";

            $detail = $this->db->query($query_insert_detail);

            $query_insert_stok  = $this->db->query("INSERT INTO `stok` 
                (no_dokumen, tanggal, id_gudang, id_barang, qty, `status`, aktif, tgl_update)VALUES
                ('".$kd_trans."', '".$tgl."', '".$id_gudang."', '".$id_barang."', '".$qty."', 'OUT', '1', '".dbnow()."')");
            }

        }

        if ($detail === false AND $header === false){
            $this->db->trans_rollback();
            return "ERROR INSERT";
        }else{
            $this->db->trans_commit();
            return $kd_trans; 
        } 
    }

    function get_production_header($id){
        $sql  = $this->db->query("SELECT a.no_produksi, a.id_gudang, a.tgl, a.id_barang, a.qty, b.nama nama_gudang, c.nama_barang
                                    FROM produksi_header a
                                    LEFT JOIN gudang b ON a.id_gudang=b.id_gudang
                                    LEFT JOIN barang c ON a.id_barang=c.id_barang
                                    WHERE a.id_produksi='".$id."'")->row();

        return $sql;
    }

    function get_production_detail($id){
        $sql  = $this->db->query("SELECT a.id_gudang, a.id_barang, a.qty, b.nama nama_gudang, c.nama_barang, c.kd_barang
                                    FROM produksi_detail a
                                    LEFT JOIN gudang b ON a.id_gudang=b.id_gudang
                                    LEFT JOIN barang c ON a.id_barang=c.id_barang
                                    WHERE a.id_produksi='".$id."'")->result();
        return $sql;
    }

    function get_stok_barang($periode,$idbarang,$idgudang){
        $sql  = "SELECT a.id_gudang,c.nama nama_gudang, a.id_barang, b.kd_barang, b.nama_barang,
            (SELECT IFNULL(SUM(d.qty),0) FROM stok d WHERE a.id_barang=d.id_barang AND a.id_gudang=d.id_gudang AND DATE_FORMAT(d.tanggal, '%Y-%m')='".$periode."' AND d.status='IN' AND d.aktif='1') trn_masuk,
            (SELECT IFNULL(SUM(d.qty),0) FROM stok d WHERE a.id_barang=d.id_barang AND a.id_gudang=d.id_gudang AND DATE_FORMAT(d.tanggal, '%Y-%m')='".$periode."' AND d.status='OUT' AND d.aktif='1') trn_keluar,
            ((SELECT IFNULL(SUM(d.qty),0) FROM stok d WHERE a.id_barang=d.id_barang AND a.id_gudang=d.id_gudang AND DATE_FORMAT(d.tanggal, '%Y-%m')='".$periode."' AND d.status='IN' AND d.aktif='1')-
            (SELECT IFNULL(SUM(d.qty),0) FROM stok d WHERE a.id_barang=d.id_barang AND a.id_gudang=d.id_gudang AND DATE_FORMAT(d.tanggal, '%Y-%m')='".$periode."' AND d.status='OUT' AND d.aktif='1')) saldo_awal
            FROM stok a  LEFT JOIN barang b ON a.id_barang=b.id_barang
                 LEFT JOIN gudang c ON a.id_gudang=c.id_gudang
                 WHERE a.aktif='1' ";
        if($idbarang!=0){
        $sql .= " AND a.id_barang='".$idbarang."'";
        }
        if($idgudang!=0){
        $sql .= " AND a.id_gudang='".$idgudang."'";
        }
        $sql .=" GROUP BY a.id_gudang, a.id_barang
        ORDER BY a.id_barang,a.id_gudang";
        //test($sql,1);
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function detail_report_stok($id, $periode, $idgudang){
        $sql =  "SELECT a.no_dokumen, a.tanggal, a.id_gudang, a.id_barang, a.qty, a.status FROM stok a
                WHERE a.aktif='1' AND a.id_barang='".$id."' AND a.id_gudang='".$idgudang."' AND DATE_FORMAT(a.tanggal, '%Y-%m')='".$periode."'";
                    //test($sql,0);
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function detail_report_stok_num_rows($id, $periode){
        $sql =  "SELECT a.kd_trans, a.tgl, a.keterangan, b.id_barang, b.qty, a.jns_trans
                    FROM trn_barang_header a, trn_barang_detail b
                    WHERE a.id_trans=b.id_trans AND a.status='CO' AND b.id_barang='".$id."'
                    AND DATE_FORMAT(a.tgl, '%Y-%m')='".$periode."' order by a.jns_trans";
        $query = $this->db->query($sql)->num_rows();
        return $query;
    }

    function total_masuk_stok($id, $periode, $idgudang){
        $sql =  "SELECT SUM(a.qty) qty FROM stok a WHERE a.aktif='1' AND a.id_barang='".$id."' AND a.id_gudang='".$idgudang."' 
                AND DATE_FORMAT(a.tanggal, '%Y-%m')='".$periode."' AND a.status='IN'";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function total_keluar_stok($id, $periode, $idgudang){
        $sql =  "SELECT SUM(a.qty) qty FROM stok a WHERE a.aktif='1' AND a.id_barang='".$id."' AND a.id_gudang='".$idgudang."' 
                AND DATE_FORMAT(a.tanggal, '%Y-%m')='".$periode."' AND a.status='OUT'";
        $query = $this->db->query($sql)->row();
        return $query;
    }
}	  
?>