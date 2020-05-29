<section>
  <h4 class="text-center">TRANSAKSI RETUR BARANG KELUAR</h4>
  <table>
    <tr align="left" class="h5">
      <td width=50%></td>
      <td width=5%>Nomor </td>
      <td width=1%>:</td>
      <td width=15%><?php echo $data_header->kd_trans; ?></td>
    </tr>
    <tr align="left" class="h5">
      <td></td>
      <td>Tanggal </td>
      <td>:</td>
      <td><?php echo date('d M y', strtotime($data_header->tgl));  ?></td>
    </tr>
    <tr align="left" class="h5">
      <td></td>
      <td>Toko </td>
      <td>:</td>
      <td><?php echo $data_header->nama_toko;  ?></td>
    </tr>
    <tr align="left" class="h5">
      <td></td>
      <td>Gd Tujuan </td>
      <td>:</td>
      <td><?php echo $data_header->nama_gudang;  ?></td>
    </tr>
    <tr align="left" class="h5">
      <td></td>
      <td>Keterangan </td>
      <td>:</td>
      <td><?php echo $data_header->keterangan;  ?></td>
    </tr>
  </table>
  <div class="content-header"></div>
</section>
<section class="content">
  <table id="table-kaskecil" class="table table-inverse">

    <tbody>
    <tr align="left">
      <th width="5%">No.</th>
      <th width="25%">No. Transaksi</th>
      <th width="25%">Kode Barang</th>
      <th width="40%">Nama Barang</th>
      <th width="8%">QTY</th>
    </tr>
    </tbody>

    <?php 
    $no   = 0; 
    foreach($data_detail as $data): 
    $no   = $no+1;
    ?>
    <tr>
      <td><?php echo $no; ?>.</td>
      <td><?php echo $data_header->kd_trans; ?></td>
      <td><?php echo $data->kd_barang; ?></td>
      <td><?php echo $data->nama_barang; ?></td>
      <td align="right"><?php echo $data->qty; ?></td>  
    </tr>   
    <?php endforeach; ?>
    <tbody>
  </table>
  <div class="content-header"></div>
</section>
</br>
<table>
  <tr align="center">
    <td width=30%></td>
    <td width=15%></td>
    <td width=15%></td>
    <td width=15%>Disetujui,<br><br><br><br><br>( ___________ )</td>
    <td width=15%>Diterima<br><br><br><br><br>( ___________ )</td>
  </tr>
</table>
<script>//window.print(); window.close();</script>