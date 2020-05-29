<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">View Admin</h1>
    </div>
    <div class="col-lg-1">
        <h1 class="page-header"><a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/form'); ?>">Input</a></h1>
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
                                <td><?php echo $value->username; ?></td>
                                <td>
                                <a class="btn btn-warning btn-xs" href="<?php echo base_url('admin/edit/'.$value->id_user); ?>">Edit</a>
                                <button class="btn btn-danger btn-xs" id="delete" data-id="<?php echo $value->id_user; ?>" data-username="<?php echo $value->username; ?>">Hapus</button>
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

        $('#dataTables-example').on('click','#delete', function(e){

		    var id  		= $(this).data('id');
		    var username  	= $(this).data('username');
	        var txt;

			var r = confirm("Apakah Anda Ingin Menghapus "+username+' ?');
			if (r == true) {
				$.ajax({
				    data: {
				      id  : id
				    },
				    type : "POST",
				    url: baseUrl+'admin/delete',
				    success : function(resp){
				    	if(resp.status == false){
							alert('Data Gagal Di Hapus');
						}else{
							alert('Data Berhasil Di Hapus');
							setTimeout(function () {
					            window.location.href = baseUrl+'admin/'; 
					        }, 2000);
						}
				    }
				});
			}
        });
    });
</script>