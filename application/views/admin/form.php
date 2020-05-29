<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forms Admin</h1>
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
	                                <label class="col-lg-3">Username</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="username">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_user" style="color: red">* Username Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Password</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="password" id="password">
	                                </div>
	                                <div class="col-lg-3">
		                                <p class="help-block notif" id="notif_pass" style="color: red">* Password Tidak Boleh Kosong.</p>
	                                	</div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Konfirmasi Password</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="password" id="konf_password">		                               
	                                </div>
	                                <div class="col-lg-4">
	                                	<p class="help-block notif" id="notif_konf" style="color: red">* Konfirmasi Password Tidak Boleh Kosong.</p>
		                                <p class="help-block notif" id="notif_oke" style="color: green">* Konfirmasi Password Cocok.</p>
		                                <p class="help-block notif" id="notif_not" style="color: red">* Konfirmasi Password Tidak Cocok.</p>
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
		if($('#username').val()==''){
			$('#notif_user').show();
			$('#username').focus();
			return false;
		}

		if($('#password').val()==''){
			$('#notif_pass').show();
			$('#password').focus();
			return false;
		}

		if($('#konf_password').val()==''){
			$('#notif_konf').show();
			$('#konf_password').focus();
			return false;
		}else{
			$('#notif_konf').hide();
		}

		if($('#password').val()==$('#konf_password').val()){
			$('#notif_not').hide();
			$('#notif_oke').show();
		}else{
			$('#notif_oke').hide();
			$('#notif_not').show();
			$('#konf_password').focus();
			return false;
		}

		$.ajax({
			url			: baseUrl+'admin/form_act',
			type 		: 'POST',
			data 		: {
				username 		: $('#username').val(),
				password 		: $('#password').val()
			},
			success : function(resp){
				if(resp.status == false){
					alert('Data Gagal Di simpan');
				}else{
					alert('Data Berhasil Di Simpan');
					setTimeout(function () {
			            window.location.href = baseUrl+'admin/'; 
			        }, 2000);
				}
			}
		});
	});
</script>

<?php 

?>