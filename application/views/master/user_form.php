<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Input User</h3>
    <ul class="header-toolbox">
      <li class="bottom_input"><a keypress="alt b" class="btn btn-warning btn-sm" onclick="window.history.go(-1); return false;"><u>B</u>atal</a></li>
    </ul>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url().'welcome'; ?>">Home</a></li>
      <li>Master</li>
      <li>Input User</li>
    </ol>
  </div>  
</div>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
    	<div class="panel-body">
            <?php echo form_open(base_url()."user/form_act",array('data-toggles'=>'validator','class'=>'form-horizontal')); ?>
                <div class="form-group">
					<label class="col-sm-2 control-label">NIP </label>
					<div class="col-sm-3">
						<input tabindex="102" type="text" name="nip" id="nip" class="form-control" required="required">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">NRK </label>
					<div class="col-sm-5">
						<input tabindex="102" type="text" name="nrk" id="nrk" class="form-control" required="required">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama </label>
					<div class="col-sm-8">
						<input tabindex="102" type="text" name="nama" id="nama" class="form-control" required="required">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Jabatan </label>
					<div class="col-sm-6">
						<textarea tabindex="103" class="form-control" rows="3" id="jabatan" name="jabatan"></textarea>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Aktif </label>
					<div class="col-sm-2">
						<input tabindex="104" type="checkbox" name="aktif" id="aktif" value="1" required="required">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
		      	<label class="col-sm-2 control-label">Kelamin</label>
                  <div class="controls col-sm-6">
                  	<label>
                      <input type="radio" name="kelamin" id="optionsRadios1" value="L" checked=""> Pria &nbsp;&nbsp;&nbsp;
                    </label>
                    <label>
                      <input type="radio" name="kelamin" id="optionsRadios2" value="P"> Wanita
                    </label>
                  </div>
              	</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Username </label>
					<div class="col-sm-5">
						<input tabindex="102" type="text" name="username" id="username" class="form-control" required="required">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password </label>
					<div class="col-sm-5">
						<input tabindex="102" type="password" name="password" id="password" class="form-control" required="required">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Konf Password </label>
					<div class="col-sm-5">
						<input tabindex="102" type="password" name="confirm_password" id="confirm_password" class="form-control" required="required">
						<div class="help-block with-errors"><span id='message'></span></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Hak Akses </label>
					<div class="col-sm-5">
						<select tabindex="102" name="hak_akses" id="hak_akses" class="form-control" style="width: 75%;" required="required">
				        	<option value="">Pilih Hak Akses</option>
				        	<option value="1">Super Admin</option>
				        	<option value="2">Admin Gudang</option>
				        </select>
						<div class="help-block with-errors"><span id='message'></span></div>
					</div>
				</div>
				</br>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-2">
						<button tabindex="120" keypress='alt s' type="submit" class="btn light-green" id="saveNI" name="save" value="save" notab><u>S</u>impan</button>
					</div>
				</div>
            <?php echo form_close(); //test($new_ni); ?>
		</div>
    </section>
  </div>
</div>


<script type="text/javascript">
APL.Brg = {
  	processed: false,
  	init: function(){

  	$('#password, #confirm_password').on('keyup', function () {
	  	if ($('#password').val() == $('#confirm_password').val()) {
	    	$('#message').html('Cocok').css('color', 'green');
	  	} else 
	    	$('#message').html('Tidak Cocok').css('color', 'red');
	});

    }
};

APL.Brg.init();
</script>