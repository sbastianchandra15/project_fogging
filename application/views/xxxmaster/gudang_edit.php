<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Edit Gudang</h3>
    <ul class="header-toolbox">
      <li class="bottom_input"><a keypress="alt b" class="btn btn-warning btn-sm" onclick="window.history.go(-1); return false;"><u>B</u>atal</a></li>
    </ul>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url().'welcome'; ?>">Home</a></li>
      <li>Master</li>
      <li>Edit Gudang</li>
    </ol>
  </div>  
</div>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
    	<div class="panel-body">
            <?php echo form_open(base_url()."gudang/edit_act",array('data-toggles'=>'validator','class'=>'form-horizontal')); ?>
                <div class="form-group">
					<label class="col-sm-3 control-label">Nama Gudang </label>
					<div class="col-sm-8">
						<input tabindex="101" type="text" name="nama" id="nama" class="form-control" required="required" value="<?php echo $detail->nama; ?>">
						<input tabindex="101" type="hidden" name="id_gudang" id="id_gudang" class="form-control" value="<?php echo $detail->id_gudang; ?>">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat </label>
					<div class="col-sm-6">
						<textarea tabindex="102" class="form-control" rows="3" id="alamat" name="alamat"><?php echo $detail->alamat; ?></textarea>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Aktif </label>
					<div class="col-sm-2">
						<input tabindex="103" type="checkbox" name="aktif" id="aktif" value="1" <?php echo ($detail->aktif==1)? 'checked="checked"' : ''; ?>>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telp </label>
					<div class="col-sm-3">
						<input tabindex="104" type="text" name="telp" id="telp" class="form-control" required="required" value="<?php echo $detail->telp; ?>">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				</br>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-2">
						<button tabindex="105 keypress='alt s' type="submit" class="btn light-green" id="saveNI" name="save" value="save" notab><u>S</u>impan</button>
					</div>
				</div>
            <?php echo form_close(); //test($new_ni); ?>
		</div>
    </section>
  </div>
</div>

