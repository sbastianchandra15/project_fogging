<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Edit Barang</h3>
    <ul class="header-toolbox">
      <li class="bottom_input"><a keypress="alt b" class="btn btn-warning btn-sm" onclick="window.history.go(-1); return false;"><u>B</u>atal</a></li>
    </ul>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url().'welcome'; ?>">Home</a></li>
      <li>Master</li>
      <li>Edit Barang</li>
    </ol>
  </div>  
</div>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
    	<div class="panel-body">
            <?php echo form_open(base_url()."barang/edit_act",array('id'=>'frmBKB','data-toggles'=>'validator','class'=>'form-horizontal')); ?>
                <div class="form-group">
					<label class="col-sm-2 control-label">Kode barang </label>
					<div class="col-sm-3">
						<input tabindex="102" type="text" name="kd_barang" id="kd_barang" class="form-control" required="required" value="<?php echo $detail->kd_barang; ?>">
						<input type="hidden" name="id_barang" id="id_barang" class="form-control" required="required" value="<?php echo $detail->id_barang; ?>">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama barang </label>
					<div class="col-sm-8">
						<input tabindex="102" type="text" name="nama_barang" id="nama_barang" class="form-control" required="required" value="<?php echo $detail->nama_barang; ?>">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Kategori </label>
					<div class="col-sm-8">
						<select name="kategori" id="kategori" class="form-control" required="required">
							<option value="ATK" <?php echo ($detail->kategori=='ATK')? 'selected="selected"' : '' ?>>ATK</option>
							<option value="Habis Pakai" <?php echo ($detail->kategori=='Habis Pakai')? 'selected="selected"' : '' ?>>Habis Pakai</option>
						</select>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sm-3 control-label">Saldo </label>
					<div class="col-sm-3">
						<input tabindex="102" type="number" class="form-control" required="required" value="<?php echo $detail->saldo; ?>" disabled="">
						<div class="help-block with-errors"></div>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-2 control-label">Aktif </label>
					<div class="col-sm-2">
						<input tabindex="102" type="checkbox" name="aktif" id="aktif" value="1" <?php if($detail->aktif==1){ echo 'checked="checked"	'; } ?> >
						<div class="help-block with-errors"></div>
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

	$("#kategori").select2().on('select2:select',function(e){
        $('#nominal_debit').focus();
      });

    }
};

APL.Brg.init();
</script>