<section class="content-header">
	<h1 class="title">Pro<small>Production</small></h1>
	<ul class="header-toolbox">
		<li><a keypress="alt k" class="btn light-green pull-right" onclick="window.history.go(-1); return false;"><u>K</u>eluar</a></li>
	</ul>
</section>
<section class="content-body">
	<div class="box">
    	<div class="box-body">
			<?php echo form_open(current_url(),array('data-toggles'=>'validator','class'=>'form-horizontal')); ?>
				<input type="hidden" name="ni_items" id="ni_items" value='<?php echo json_encode($new_prod["items"]); ?>' required />
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal </label>
							<div class="col-sm-3">
								<input tabindex="101" type="text" name="tanggal" id="tanggal" class="form-control" required="required" value="<?php echo isset($new_prod['tanggal']) ? $new_prod['tanggal']:''; ?>">
								<div class="help-block with-errors"></div>
							</div>
						</div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Gudang Tujuan </label>
              <div class="col-sm-5">
                <select tabindex="102" name="gd_tujuan" id="gd_tujuan" class="form-control" style="width: 75%;" required="required">
                    <option value="">Pilih Gudang</option>
                    <?php
                        foreach ($data_gudang as $row) {
                          if($row->id_gudang==$new_prod['gd_tujuan']){
                            echo "<option value=".$row->id_gudang." selected>".$row->nama."</option>";
                          }else{
                            echo "<option value=".$row->id_gudang.">".$row->nama."</option>";
                          }
                        }
                      ?>
                    </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Barang Jadi </label>
							<div class="col-sm-6">
								<select tabindex="103" type="search" name="id_barang" id="id_barang_jadi" class="form-control pull-left" required="required">
                  <option value="">Pilih Barang Jadi</option>
                  <?php
                      foreach ($data_barang_jadi as $row) {
                        if($row->id_barang==$new_prod['id_barang_jadi']){
                          echo "<option value=".$row->id_barang." selected>".$row->nama_barang."</option>";
                        }else{
                          echo "<option value=".$row->id_barang.">".$row->nama_barang."</option>";
                        }
                      }
                  ?>
                </select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Qty Barang Jadi </label>
              <div class="col-sm-6">
                <input tabindex="105" type="text" name="qty_jadi" id="qty_jadi" class="form-control" required="required" value="<?php echo isset($new_prod['qty_jadi']) ? $new_prod['qty_jadi']:''; ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
							<label for="search_item" class="col-sm-3 control-label">Item Barang</label>
							<div class="col-sm-9">
								<div style="width:80%;">
									<select tabindex="106" type="search" name="id_barang" id="id_barang" class="form-control pull-left" style="width: 75%;" required="required">
							        	<option value="">Pilih Barang</option>
							        	<?php
							             	foreach ($data_barang_mentah as $row) {
							             		echo "<option value=".$row->id_barang.">".$row->nama_barang."</option>";
							             	}
						            	?>
							    </select>
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div>
            <div class="form-group">
              <label for="search_item" class="col-sm-3 control-label">Gudang Barang</label>
              <div class="col-sm-9">
                <div style="width:80%;">
                  <select tabindex="107" name="gd_barang" id="gd_barang" class="form-control" style="width: 75%;" required="required">
                    <option value="">Pilih Gudang</option>
                    <?php
                        foreach ($data_gudang as $row) {
                          echo "<option value=".$row->id_gudang.">".$row->nama."</option>";
                        }
                      ?>
                  </select>
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
						<div class="form-group">
							<label for="keterangan_detail" class="col-sm-3 control-label">Qty</label>
							<div class="col-sm-2">
								<input tabindex="108" type="text" name="qty" id="qty" class="form-control" required="required">
							</div>
						</div>
						<div class="form-group form-action">
							<div class="col-sm-9 col-sm-offset-3">
								<button tabindex="109" id="add-item" class="btn btn-info" notab keypress='alt t'><u>T</u>ambah Detail</button> 
							</div>
						</div>
					</div>
				</div>
				<hr />

				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label for="search_item" class="col-sm-1 control-label"></label>
							<div class="col-sm-10">
								<table id="table-detail" class="table table-hover table-bordered dataTable">
									<thead>
									<th width="30%">Kode Barang</th>
                  <th width="30%">Gudang</th>
									<th width="10%">Qty</th>
									<th width="5%"></th>
									</thead>
								</table>
							</div>
						</div>
						
					</div>
				</div>

				<div class="box-footer">
		      		<button tabindex="120" keypress='alt s' type="submit" class="btn light-green" id="saveNI" name="save" value="save" notab><u>S</u>impan</button>
					<a keypress='alt b' tabindex="121" class="btn btn-default" href="<?php echo base_url('production/reset'); ?>" notab><u>B</u>atal</a>
		    	</div>
			<?php //echo test($new_prod); ?>
		</div>
	</div>
</section>
<script type="text/javascript">
APL.Brg = {
	data: {},
  	processed: false,
  	items: [],
  	init: function(){

		$("#id_barang").select2().on('select2:select',function(e){});
    $("#id_barang_jadi").select2().on('select2:select',function(e){});
    $("#gd_tujuan").select2().on('select2:select',function(e){});
    $("#gd_barang").select2().on('select2:select',function(e){});

		$('#add-item').click(APL.Brg.add_item);

		

		this.tanggal  		  = $("#tanggal");
  	this.id_barang_jadi = $("#id_barang_jadi");
    this.gd_tujuan      = $("#gd_tujuan");
    this.qty_jadi       = $("#qty_jadi");

  	$('#saveNI').click(APL.Brg.save);

  	var currentDate = new Date();
    $('#tanggal').datepicker({
        format: "yyyy-mm-dd",
        autoclose:true,
        inline: true,
    });
    $("#tanggal").datepicker("setDate", currentDate);

		this.grids = $('#table-detail').DataTable({
	        "bSort" : false, 
	        data: [], 
	        fixedColumns: true, 
	        "searching": false,
	        "paging": false, 
	        "bLengthChange": false, 
	        "info": false,
	        "columnDefs": [{
	          "targets": [0], "visible": true, "searchable": false
	        }],
	        "language": {
	          "emptyTable": "Tidak Ada Data"
	        },
	        columns: [
	           { data: 'kd_barang' },{ data: 'gudang' }, { data: 'qty' }, { data: 'act' }
	        ],
	        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull){

	        }
	    });

    this._set_items($('#ni_items').val());

    },

    add_item: function(e){
      //debugger
      e.preventDefault();
      if(!$('#id_barang').val()){
        alert('Kolom Barang Tidak Boleh Kosong');
      }

      if(!$('#qty').val()){
        alert('Qty Tidak Boleh Kosong');
      }

        let qty           = $('#qty').val();
        let barang		    = $('#id_barang').val();
        let kd_barang     = $('#id_barang option:selected').text();
        let id_gudang     = $('#gd_barang').val();
        let gudang        = $('#gd_barang option:selected').text();
        let tanggal        = $("#tanggal").val();
        let id_barang_jadi = $("#id_barang_jadi").val();
        let gd_tujuan      = $("#gd_tujuan").val();
        let qty_jadi       = $("#qty_jadi").val();

        if(qty){
    			data = {
    				qty       : qty,
    				barang : barang,
    				kd_barang : kd_barang,
            id_gudang : id_gudang,
            gudang : gudang,
            tanggal : tanggal,
            id_barang_jadi : id_barang_jadi,
            gd_tujuan : gd_tujuan,
            qty_jadi : qty_jadi
    			};

          APL.Brg._addtogrid(data);
          APL.Brg._clearitem();
          APL.Brg._focusadd();
        }

        var data = {
        	qty          : $('#qty').val(),
        	barang		   : $('#id_barang').val(),
        	kd_barang    : $('#id_barang option:selected').text(),
          id_gudang    : $('#gd_barang').val(),
          gudang       : $('#gd_barang option:selected').text()

        };

        var exist = false;
        APL.Brg.items.map(function(it,ix){
          if (it.id_barang == data.id_barang){
            exist = true; return;
          }
        });
        if(!exist) APL.Brg.items.push(data);

    },

    _addtogrid: function(data){
    	//debugger
      let grids = this.grids;
      let exist = APL.Brg.grids.row('#'+data.kd_barang).index();
      //
      $('#id').val(data.kd_barang);

      data.act = '<button item-code="'+data.kd_barang+'" onclick="return APL.Brg._removefromgrid(this);">x</button>';
      data.DT_RowId = data.kd_barang;
      //
      if(exist===undefined){
        grids.row.add(data).draw();
      }else{ 
        data.qty              = parseInt(grids.row(exist).data().qty) + parseInt(data.qty);
        grids.row(exist).data(data).draw(false);
      }

      if(this.no_ajax) return false;

      $.post({
        url: APL.baseUrl+'production/add_item',
        data: {
        	tanggal 		  : data.tanggal,
        	id_barang_jadi: data.id_barang_jadi,
          gd_tujuan     : data.gd_tujuan,
          qty_jadi      : data.qty_jadi,

        	qty       		: data.qty,
    			id_barang 		: data.barang,
    			kd_barang 		: data.kd_barang,
    			nama_barang 	: data.nama_barang,
          id_gudang     : data.id_gudang,
          gudang        : data.gudang,
    			id        		: data.jumlah
        }
      });
      },

    _set_items: function(items){
      //debugger
      this.no_ajax = true;
      //
      if(items) items = JSON.parse(items);
      this.items = items;
      items.map(function(i,e){
        var data = {
        	qty       : i.qty,
    			id_barang : i.id_barang,
    			kd_barang : i.kd_barang,
          id_gudang : i.id_gudang,
          gudang    : i.gudang
        };
        APL.Brg._addtogrid(data);
      });
      this.no_ajax = false;

    },

    _clearitem: function(){
      $('#qty').val('');
      $('#id_barang').val('').trigger('change');
      $('#gd_barang').val('').trigger('change');
    },

    _focusadd: function(){
        $('#id_barang').focus();
    },

    _removefromgrid: function(el){

      let code = $(el).attr('item-code');
      APL.Brg.grids.row("#"+code).remove().draw();
      $.get({
        url: APL.baseUrl+'production/remove_item',
        data: {
          index_code: code
        }
      });
      return false;
    },

    _clearForm: function(){
      $('#tanggal').val('');
      $('#keterangan').val('');
      APL.Brg._clearitem();    
    },

    save: function(e){

      e.preventDefault();

      if(!$('#tanggal').val()){
        alert('Kolom Tanggal Tidak Boleh Kosong');
        return false;
      }

      if(!$('#id_barang_jadi').val()){
        alert('Kolom Barang Jadi Tidak Boleh Kosong');
        return false;
      }

      if(!$('#gd_tujuan').val()){
        alert('Kolom Gudang Tujuan Tidak Boleh Kosong');
        return false;
      }

      if(!$('#qty_jadi').val()){
        alert('Kolom Qty barang jadi Tidak Boleh Kosong');
        return false;
      }
      
      $.ajax({       
        data: { },     
        type : "POST",        
        url: APL.baseUrl+'production/save',
        success : function(resp){
          
          if(resp.nomor_dok == 'ERROR INSERT' || resp.nomor_dok == false) {
            $.notify({
              icon: "img/growl_64x.png",
              message: "Data Gagal disimpan"
            },{
              type: 'danger'
            });
            return false;
          }else {
            APL.Brg._clearForm();
            $.notify({

              icon: "glyphicon glyphicon-save",
              message: "Data sudah disimpan dengan nomor Transaksi "+resp.nomor_dok
            });

            setTimeout(function () {
              window.location.href = APL.baseUrl+'production/'; //will redirect to google.
            }, 2000);
          }
        }
      })
    }

};

APL.Brg.init();
</script>