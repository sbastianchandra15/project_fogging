<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forms Kategori</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form">
                        	<div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Nama Kategori</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="kategori">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_kategori" style="color: red">* Kategori Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
	    <button type="submit" class="btn btn-info" id="simpan">Simpan</button>
	    <button type="reset" class="btn btn-danger">Batal</button>
    </div>
</div>

<script type="text/javascript">
	$('.notif').hide();

	$('#simpan').click(function(){
		$('.notif').hide();
		if($('#kategori').val()==''){
			$('#notif_kategori').show();
			$('#kategori').focus();
			return false;
		}

		$.ajax({
			url			: baseUrl+'kategori/form_act',
			type 		: 'POST',
			data 		: {
				kategori 		: $('#kategori').val()
			},
			success : function(resp){
				if(resp.status == false){
					alert('Data Gagal Di simpan');
				}else{
					alert('Data Berhasil Di Simpan');
					setTimeout(function () {
			            window.location.href = baseUrl+'kategori/'; 
			        }, 2000);
				}
			}
		});
	});
</script>

<?php 

?>