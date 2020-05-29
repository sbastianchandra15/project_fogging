<div class="row hidden-print">
  <div class="col-lg-12">
    <h3 class="page-header">Report Barang</h3>
    <ul class="header-toolbox">
      <li class="bottom_input"><button class="btn btn-info btn-sm" class="btn btn-info btn-sm" onclick="myFunction()"><u>P</u>rint</button></li>
    </ul>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url().'welcome'; ?>">Home</a></li>
      <li>Report</li>
      <li>Report Barang</li>
    </ol>
  </div>  
</div>

<div class="content-wrapper">
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table class="table table-print">
          <tbody>
            <tr align="center">
              <td width="5%">No. </td>
              <td width="15%">Kode Barang</td>
              <td>Nama Barang</td>
  			<td>Saldo</td>
            </tr>
            <?php 
            $no = 0;
            foreach ($data_barang as $key => $vd) {
            $no = $no+1;
            ?>
            <tr>
              <td align="right"><?php echo $no; ?>.</td>
              <td><?php echo $vd->kd_barang; ?></td>
              <td><?php echo $vd->nama_barang; ?></td>
  			<td><?php echo $vd->saldo; ?></td>
            </tr>
            <?php 
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<script>
function myFunction() {
  window.print();
}
</script>