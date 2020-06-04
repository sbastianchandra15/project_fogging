<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">View Customers</h1>
    </div>
    <div class="col-lg-1">
        <h1 class="page-header"><a class="btn btn-primary btn-sm" href="<?php echo base_url('customer/form'); ?>">Input</a></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- <div class="panel-heading">
                DataTables Advanced Tables
            </div> -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Nama</th>
                                <th>No KTP</th>
                                <!-- <th>Telp</th> -->
                                <!-- <th>Tgl Lahir</th> -->
                                <th>Tgl Register</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php 
                        	$no=0;
                        	foreach ($data_view as $key => $value) {
                        	$no 		= $no+1;
                        	?>
                            <tr class="odd gradeX">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $value->nama; ?></td>
                                <td><a target="_blank" href="<?php echo base_url('file_upload/'.$value->scan_ktp) ?>"><?php echo $value->no_ktp; ?></td>
                                <!-- <td><?php echo $value->telp; ?></td> -->
                                <!-- <td><?php echo $value->tgl_lahir; ?></td> -->
                                <td><?php echo $value->tgl_register; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->username; ?></td>
                                <td>
                                <a class="btn btn-warning btn-xs" href="<?php echo base_url('customer/edit/'.$value->no_ktp); ?>">Edit</a>
                                <button class="btn btn-danger btn-xs" id="delete" data-no_ktp="<?php echo $value->no_ktp; ?>" data-nama="<?php echo $value->nama; ?>">Hapus</button>
                                </td>
                            </tr>
                            <?php 
                        	}
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });

        function addfile(){
            var fd = new FormData();
            fd.append('file_quotation',file.file_quotation);

            $.post({
                url: baseUrl+'customer/add_file/'+file.no_ktp,
                data: fd,
                cache: false,
                contentType: false,
                processData: false
            });
        }

        $('#dataTables-example').on('click','#delete', function(e){

		    var no_ktp		      = $(this).data('no_ktp');
		    var customer  	      = $(this).data('nama');

            var file_quotation    = $('#file')[0].files[0];

            file = {
                file_quotation  : file_quotation,
                no_ktp          : no_ktp
            };

            addfile(file);

	        var txt;
			var r = confirm("Apakah Anda Ingin Menghapus "+customer+' ?');
			if (r == true) {
				$.ajax({
				    data: {
				      no_ktp  : no_ktp
				    },
				    type : "POST",
				    url: baseUrl+'customer/delete',
				    success : function(resp){
				    	if(resp.status == false){
							alert('Data Gagal Di Hapus');
						}else{
							alert('Data Berhasil Di Hapus');
							setTimeout(function () {
					            window.location.href = baseUrl+'customer/'; 
					        }, 2000);
						}
				    }
				});
			}
        });
    });
</script>