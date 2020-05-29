<div class="row hidden-print">
  <div class="col-lg-12">
    <h3 class="page-header">Pergerakan Stok</h3>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url().'welcome'; ?>">Home</a></li>
      <li>Report</li>
      <li>Pergerakan Stok</li>
    </ol>
  </div>  
</div>

<div class="row hidden-print">
  <div class="col-lg-12">
    <section class="panel">
      <div class="box no-print">
        <?php echo form_open(base_url()."pergerakan_stok/report_stok",array('data-toggles'=>'validator','class'=>'form-horizontal','target'=>'_blank')); ?>
        <div class="box-body">
          <div class="form-group">
            <label for="store" class="col-md-2 control-label">Barang </label>
            <div class="input-group col-md-3">
              <select name='barang' id='barang' class="form-control" required="required">
                <option value="0">Semua Barang</option>
                <?php
                  foreach ($data_barang as $row_barang) {
                    echo "<option value=".$row_barang->id_barang.">".$row_barang->nama_barang."</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="store" class="col-md-2 control-label">Gudang </label>
            <div class="input-group col-md-3">
              <select name='gudang' id='gudang' class="form-control" required="required">
                <option value="0">Semua Gudang</option>
                <?php
                  foreach ($data_gudang as $row_gudang) {
                    echo "<option value=".$row_gudang->id_gudang.">".$row_gudang->nama."</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="store" class="col-md-2 control-label">Bulan & Tahun </label>
            <div class="input-group col-md-3">
              <input id="val_tanggal" name="val_tanggal" class="date-picker" />
            </div>
          </div>
          </br>
          <div class="form-group">
            <label for="store" class="col-md-2 control-label"></label>
            <div class="input-group col-md-5">
              <button type="submit" id="add-item" class="btn btn-primary">Lihat</button>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </section>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
    <?php if(isset($cari)){ ?>
      <div class="box">
        <div class="box-body">
          Pergerakan Stok Bulan <?php echo $pil_bulan; ?> Tahun <?php echo $pil_tahun; ?>
          <?php 
          $periode = $bulan_tahun;
          //test($periode,1);
          $saldo_akhir = 0;
          $total_masuk = 0;
          $total_keluar = 0;
          foreach ($data_stok as $key => $value) {
            $total_masuk = $this->transaksi_model->total_masuk_stok($value->id_barang, $pil_periode, $value->id_gudang);
            $total_keluar = $this->transaksi_model->total_keluar_stok($value->id_barang, $pil_periode, $value->id_gudang);
            $saldo_akhir = ($value->saldo_awal+$total_masuk->qty)-$total_keluar->qty;
          ?>
          <table class="table table-print">
            <tbody>
              <tr>
                <td width="5%" colspan="6">Gudang : <?php echo $value->nama_gudang; ?></td>
              </tr>
              <tr>
                <td width="5%" colspan="6">Nama Produk : <?php echo $value->nama_barang; ?></td>
              </tr>
              <tr>
                <td width="5%" colspan="6">Saldo Awal : <?php echo money($value->saldo_awal); ?></td>
              </tr>
              <tr>
                <td width="5%" colspan="6">Saldo Akhir : <?php echo money($saldo_akhir); ?></td>
              </tr>
              <tr align="center">
                <td width="5%">No. </td>
                <td width="15%">Tanggal</td>
                <td>Kode Transaksi </td>
                <td width="10%">Masuk</td>
                <td width="10%">Keluar</td>
                <td width="10%">Saldo</td>
              </tr>
              <?php
              $no = 0; 
              
              $saldo = $value->saldo_awal;
              $tkeluar= 0;
              $tmasuk = 0;
              
              $detail = $this->transaksi_model->detail_report_stok($value->id_barang, $pil_periode, $value->id_gudang);
              foreach ($detail as $key => $vd) {
              $no = $no+1;
              if($vd->status=='IN'){
                $saldo = $saldo+$vd->qty;
                $tmasuk= $tmasuk+$vd->qty;
              }elseif($vd->status=='OUT'){
                $saldo = $saldo-$vd->qty;
                $tkeluar= $tkeluar+$vd->qty;
              }
              ?>
              <tr>
                <td align="right"><?php echo $no; ?>.</td>
                <td><?php echo $vd->tanggal; ?></td>
                <td><?php echo $vd->no_dokumen; ?></td>
                <td align="right"><?php echo ($vd->status=='IN') ? money($vd->qty) : ''; ?></td>
                <td align="right"><?php echo ($vd->status=='OUT') ? money($vd->qty) : ''; ?></td>
                <td align="right"><?php echo money($saldo); ?></td>
              </tr>

              <?php 
              }
              ?>
              <tr>
                <td align="right" colspan="3">Total</td>
                <td align="right"><?php echo ($tmasuk<>0) ? money($tmasuk) : ''; ?></td>
                <td align="right"><?php echo ($tkeluar<>0) ? money($tkeluar) : ''; ?></td>
                <td align="right"></td>
              </tr>
              <?php 
              $detail_report_num_rows = $this->transaksi_model->detail_report_num_rows($value->id_barang, $pil_periode);
              if($detail_report_num_rows==0){
              ?>
              <tr>
                <td align="center" colspan="6"><b>Data Tidak Ada.</b></td>
              </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>
          <?php
          } 
          ?>
        </div>
      </div>
    <?php 
    } 
    ?>
    </section>
  </div>
</div>

<script type="text/javascript">

APL.Brg = {
    processed: false,
    init: function(){

      $("#barang").select2().on('select2:select',function(e){});
      $("#gudang").select2().on('select2:select',function(e){});
      $("#val_bulan").select2().on('select2:select',function(e){});
      $("#val_tahun").select2().on('select2:select',function(e){});

      $("#val_tanggal").datepicker( {
          format: "yyyy-mm",
          viewMode: "months", 
          minViewMode: "months",
          autoclose:true
      });
    }
};

APL.Brg.init();
</script>