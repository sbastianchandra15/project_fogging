<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forms Alat Fogging</h1>
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
	                                <label class="col-lg-3">Nama</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="nama">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_nama" style="color: red">* Nama Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Kategori</label>
	                                <div class="col-lg-5">
		                                <select class="form-control" id="id_kat">
		                                	<option value="">- Pilih -</option>
		                                	<?php 
		                                	foreach ($data_kategori as $key => $value) {
		                                	?>
			                                <option value="<?php echo $value->id_kat; ?>"><?php echo $value->kategori; ?></option>
		                                	<?php
		                                	}
		                                	?>
		                                </select>
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_id_kat" style="color: red">* Kategori Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">No Seri</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="no_seri">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_no_seri" style="color: red">* No Seri Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Tgl Beli</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="date" id="tgl_beli">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_tgl_beli" style="color: red">* Tgl Beli Tidak Boleh Kosong.</p>
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
		if($('#nama').val()==''){
			$('#notif_nama').show();
			$('#nama').focus();
			return false;
		}

		if($('#id_kat').val()==''){
			$('#notif_id_kat').show();
			$('#id_kat').focus();
			return false;
		}

		if($('#no_seri').val()==''){
			$('#notif_no_seri').show();
			$('#no_seri').focus();
			return false;
		}

		if($('#tgl_beli').val()==''){
			$('#notif_tgl_beli').show();
			$('#tgl_beli').focus();
			return false;
		}

		$.ajax({
			url			: baseUrl+'alat_fogging/form_act',
			type 		: 'POST',
			data 		: {
				nama 		: $('#nama').val(),
				id_kat 		: $('#id_kat').val(),
				no_seri		: $('#no_seri').val(),
				tgl_beli 	: $('#tgl_beli').val()
			},
			success : function(resp){
				if(resp.status == false){
					alert('Data Gagal Di simpan');
				}else{
					alert('Data Berhasil Di Simpan');
					setTimeout(function () {
			            window.location.href = baseUrl+'alat_fogging/'; 
			        }, 2000);
				}
			}
		});
	});
</script>

<?php 

?>