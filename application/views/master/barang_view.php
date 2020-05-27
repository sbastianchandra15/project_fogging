<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Master Barang</h3>
    <ul class="header-toolbox">
      <li class="bottom_input"><a keypress="alt b" class="btn btn-info btn-sm" href="<?php echo base_url()."barang/form" ?>"><u>B</u>aru</a></li>
    </ul>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url().'welcome'; ?>">Home</a></li>
      <li>Master</li>
      <li>Master Barang</li>
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
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th></th>
          </thead>
          <tbody>
          <?php
          $no   = 0;
          $total_saldo  = 0;
          foreach($data_barang as $list):
          $no   = $no+1;
          ?>
          <tr>
            <td><?php echo $no; ?>.</td>
            <td><?php echo $list->kd_barang; ?></td>
            <td><?php echo $list->nama_barang; ?></td>
            <td><?php echo $list->kategori; ?></td>
            <td class="action" align="center">
                      <!-- <button class="hapus btn btn-danger btn-xs" data-id="<?php echo $list->id_barang; ?>" data-toggle="modal" hidden="true"> Hapus </button> -->
                      
                      <a class="hapus btn btn-info btn-xs" href="<?php echo base_url()."barang/edit/$list->id_barang"; ?>">Edit</a>
            <?php if($this->session->userdata('hak_akses')=='1'){ ?>
					  <a Onclick="return confirmDelete()" class="hapus btn btn-danger btn-xs" href="<?php echo base_url()."barang/delete/$list->id_barang"; ?>">Hapus</a>
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
  		return confirm("Anda yakin untuk Menghapus data ini ?");
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
          "targets": [0,3],
          "orderable": false
        },{
          targets: 0, width: '25px', className: 'text-center'
        },{
          targets: 1, width: '135px', className: 'text-left'
        },{
          targets: 2, className: 'text-left'
        },{
          targets: 3, width: '110px'
        },{
          targets: 4, width: '70px'
        }
      ]
    });

    }
};

APL.Brg.init();
</script>