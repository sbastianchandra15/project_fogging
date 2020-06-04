<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forms Customer</h1>
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
	                                <label class="col-lg-3">No KTP</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="no_ktp">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_no_ktp" style="color: red">* No KTP Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
                        		<div class="form-group">
	                                <label class="col-lg-3">Scan KTP</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="file" id="file" name="file">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_scan_ktp" style="color: red">* Scan KTP Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
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
	                                <label class="col-lg-3">Alamat</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="alamat">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_alamat" style="color: red">* Alamat Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Telp</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="telp">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_telp" style="color: red">* Telp Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Tgl Lahir</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="date" id="tgl_lahir">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_tgl_lahir" style="color: red">* Tgl Lahir Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Tgl Register</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="date" id="tgl_register">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_tgl_register" style="color: red">* Tgl Register Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div> -->
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Email</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="email" id="email">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_email" style="color: red">* Email Tidak Boleh Kosong.</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group">
	                                <label class="col-lg-3">Username</label>
	                                <div class="col-lg-5">
		                                <input class="form-control" type="text" id="username">
	                                </div>
	                                <div class="col-lg-3">
	                                	<p class="help-block notif" id="notif_username" style="color: red">* Username Tidak Boleh Kosong.</p>
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
	function addfile(){
		var fd = new FormData();
        fd.append('file_quotation',file.file_quotation);

        $.ajax({
        	type: 'POST',
            url: baseUrl+'customer/add_file/'+file.no_ktp,
            data: fd,
            cache: false,
            contentType: false,
            processData: false
        });
	}

	$('.notif').hide();

	$('#simpan').click(function(){
		$('.notif').hide();
		if($('#no_ktp').val()==''){
			$('#notif_no_ktp').show();
			$('#no_ktp').focus();
			return false;
		}
		if($('#file').val()==''){
			$('#notif_scan_ktp').show();
			$('#file').focus();
			return false;
		}
		if($('#nama').val()==''){
			$('#notif_nama').show();
			$('#nama').focus();
			return false;
		}
		if($('#alamat').val()==''){
			$('#notif_alamat').show();
			$('#alamat').focus();
			return false;
		}
		if($('#telp').val()==''){
			$('#notif_telp').show();
			$('#telp').focus();
			return false;
		}
		if($('#tgl_lahir').val()==''){
			$('#notif_tgl_lahir').show();
			$('#tgl_lahir').focus();
			return false;
		}
		// if($('#tgl_register').val()==''){
		// 	$('#notif_tgl_register').show();
		// 	$('#tgl_register').focus();
		// 	return false;
		// }
		if($('#email').val()==''){
			$('#notif_email').show();
			$('#email').focus();
			return false;
		}
		if($('#username').val()==''){
			$('#notif_username').show();
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

		var file_quotation    = $('#file')[0].files[0];
        file = {
            file_quotation  : file_quotation,
            no_ktp          : $('#no_ktp').val()
        };
        addfile(file);

		$.ajax({
			url			: baseUrl+'customer/form_act',
			type 		: 'POST',
			data 		: {
				no_ktp 			: $('#no_ktp').val(),
				type_ktp 		: $('#file')[0].files[0].type.split('/')[1],
				nama 			: $('#nama').val(),
				alamat 			: $('#alamat').val(),
				telp 			: $('#telp').val(),
				tgl_lahir 		: $('#tgl_lahir').val(),
				// tgl_register	: $('#tgl_register').val(),
				email 			: $('#email').val(),
				username 		: $('#username').val(),
				password 		: $('#password').val()
			},
			success : function(resp){
				if(resp.status == false){
					alert('Data Gagal Di simpan');
				}else{
					alert('Data Berhasil Di Simpan');
					// setTimeout(function () {
			  //           window.location.href = baseUrl+'customer/'; 
			  //       }, 2000);
				}
			}
		});
	});
</script>

<?php 

?>