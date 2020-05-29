<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Transaksi Production</h3>
    <ul class="header-toolbox">
      <li class="bottom_input"><a keypress="alt b" class="btn btn-info btn-sm" href="<?php echo base_url()."production/form" ?>"><u>B</u>aru</a></li>
    </ul>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url().'welcome'; ?>">Home</a></li>
      <li>Transaksi</li>
      <li>Production</li>
    </ol>
  </div>  
</div>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <div class="table-responsive">
        <table id="table-barang" class="table table-hover table-bordered">
            <thead>
              <th>No.</th>
              <th>Kode Transaksi</th>
              <th>Tanggal</th>
              <th>Gudang Tujuan</th>
              <th>Nama Barang</th>
              <th></th>
            </thead>
            <tbody>
            <?php
            $no   = 0;
            $total_saldo  = 0;
            foreach($data_production as $list):
            $no   = $no+1;
            ?>
            <tr>
              <td><?php echo $no; ?>.</td>
              <td><?php echo $list->no_produksi; ?></td>
              <td><?php echo $list->tgl; ?></td>
              <td><?php echo $list->nama; ?></td>
              <td><?php echo $list->nama_barang; ?></td>
              <td class="action">
                <?php if($list->status=='VO'){  
                ?>
                  <a class="hapus btn btn-danger btn-xs" disabled>Hapus</a>
                  <a class="hapus btn btn-info btn-xs" disabled><span class="glyphicon glyphicon-print"></span></a>
                <?php
                }else{
                ?>
                  <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                  <a Onclick="return confirmDelete()" class="hapus btn btn-danger btn-xs" href="<?php echo base_url()."production/delete/$list->id_produksi"; ?>">Hapus</a>
                <?php } ?>
                  <a target="_blank" class="hapus btn btn-info btn-xs" href="<?php echo base_url()."production/cetak/$list->id_produksi"; ?>"><span class="glyphicon glyphicon-print"></span></a>
                <?php
                }
                ?>
              </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
      </div>

    </section>
  </div>
</div>

<script type="text/javascript">
function confirmDelete() {
  		return confirm("Anda yakin untuk MemHapuskan Dokumen ini ?");
	}

APL.Brg = {
  	processed: false,
  	init: function(){

	// $('.hapus').on("click", function(){
	// 	dataID = $(this).data('id');
	// 	$('#id').val(dataID);

	// });

	$('#table-barang').DataTable({
      "paging": true, 
      "bLengthChange": false, // disable show entries dan page
      "bFilter": true,
      "bInfo": false, // disable Showing 0 to 0 of 0 entries
      "bAutoWidth": false,
      "language": {
          "emptyTable": "Tidak Ada Data"
        },
      "oLanguage": {
        "oPaginate": {
        "sFirst": "Halaman Pertama", // This is the link to the first page
        "sPrevious": "Sebelum", // This is the link to the previous page
        "sNext": "Berikut", // This is the link to the next page
        "sLast": "Halaman Terakhir" // This is the link to the last page
        }
      },
      "aaSorting": [], // disable initial sorting
      "columnDefs": [
        { // disable sorting on column process buttons
          "targets": [0,4,5],
          "orderable": false
        },{
          targets: 0, width: '50px', className: 'text-center'
        },{
          targets: 1, width: '120px', className: 'text-left'
        },{
          targets: 2, width: '120px', className: 'text-left'
        },{
          targets: 3, width: '150px', className: 'text-left'
        },{
          targets: 4, className: 'text-left'
        },{
          targets: 5, width: '150px'
        }
      ]
    });

    }
};

APL.Brg.init();
</script>