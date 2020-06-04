<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Pesanan</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <form role="form"> -->
                          <div class="row">
                              <div class="form-group">
                                  <label class="col-lg-3">Tanggal </label>
                                  <div class="col-lg-2">
                                    <input class="form-control" type="date" id="tgl" value="<?php echo $header->tgl; ?>">
                                    <input class="form-control" type="hidden" id="no_pesan" value="<?php echo $header->no_pesan; ?>">
                                    <input type="hidden" name="ni_items" id="ni_items" value='<?php echo json_encode($new_ni["items"]); ?>' required />
                                  </div>
                                  <div class="col-lg-3">
                                    <p class="help-block notif" id="notif_tgl" style="color: red">* Tanggal Tidak Boleh Kosong.</p>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group">
                                  <label class="col-lg-3">Customer</label>
                                  <div class="col-lg-5">
                                    <select class="form-control" id="no_ktp">
                                      <option value="">- Pilih -</option>
                                      <?php 
                                      foreach ($data_customer as $key => $value) {
                                        if($value->no_ktp==$header->no_ktp){
                                          echo '<option value="'.$value->no_ktp.'" selected>'.$value->nama .'</option>';
                                        }else{
                                          echo '<option value="'.$value->no_ktp.'">'.$value->nama .'</option>';
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-3">
                                    <p class="help-block notif" id="notif_no_ktp" style="color: red">* Customer Tidak Boleh Kosong.</p>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group">
                                  <label class="col-lg-3">Keterangan</label>
                                  <div class="col-lg-5">
                                    <input class="form-control" type="text" id="keterangan" value="<?php echo $header->keterangan; ?>">
                                  </div>
                                  <div class="col-lg-3">
                                    <p class="help-block notif" id="notif_kategori" style="color: red">* Kategori Tidak Boleh Kosong.</p>
                                  </div>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="form-group">
                                  <label class="col-lg-3">Nama Barang</label>
                                  <div class="col-lg-5">
                                    <select tabindex="102" type="search" name="id_barang" id="id_barang" class="form-control pull-left" style="width: 75%;" required="required">
                                      <option value="">Pilih Alat</option>
                                      <?php
                                        foreach ($data_alat as $row) {
                                          echo "<option value=".$row->id_alat." data-nama='".$row->nama."'>".$row->nama."</option>";
                                        }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-3">
                                    <p class="help-block notif" id="notif_kategori" style="color: red">* Kategori Tidak Boleh Kosong.</p>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group">
                                  <label class="col-lg-3">Qty</label>
                                  <div class="col-lg-2">
                                    <input tabindex="102" type="text" name="qty" id="qty" class="form-control" required="required">
                                  </div>
                                  <div class="col-lg-3">
                                    <p class="help-block notif" id="notif_kategori" style="color: red">* Kategori Tidak Boleh Kosong.</p>
                                  </div>
                                  <input type="hidden" class="form-control " id="id" name="id" value="0"/>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group">
                                  <label class="col-lg-3">Harga</label>
                                  <div class="col-lg-2">
                                    <input tabindex="102" type="text" name="harga" id="harga" class="form-control" required="required">
                                  </div>
                                  <div class="col-lg-3">
                                    <p class="help-block notif" id="notif_kategori" style="color: red">* Harga Tidak Boleh Kosong.</p>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group">
                                  <label class="col-lg-3"></label>
                                  <div class="col-lg-5">
                                    <button tabindex="108" id="add-item" class="btn btn-info" notab keypress='alt t'><u>T</u>ambah Detail</button>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="form-group">
                              <div class="col-sm-10">
                                <table id="table-detail" class="table table-hover table-bordered dataTable">
                                  <thead>
                                  <th >Nama Barang</th>
                                  <th width="10%">Qty</th>
                                  <th width="10%">Harga</th>
                                  <th width="5%">Act</th>
                                  </thead>
                                </table>
                              </div>
                            </div>
                          </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
      <button type="submit" class="btn btn-info" id="simpan">Simpan</button>
      <a class="btn btn-danger" href="<?php echo base_url('pesan/reset'); ?>">Batal</a>
    </div>
</div>

<script type="text/javascript">
  $('.notif').hide();


  APL.Brg = {
    data: {},
    processed: false,
    items: [],
    init: function(){   

      $('#add-item').click(APL.Brg.add_item);

      this.tanggal      = $("#tanggal");
      this.keterangan   = $("#keterangan");
      this.gd_tujuan    = $("#gd_tujuan");
      

      $('#simpan').click(APL.Brg.save);

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
           { data: 'nama' }, { data: 'qty' }, { data: 'harga' }, { data: 'act' }
        ],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull){

        }
      });

      this._set_items($('#ni_items').val());

    },

    add_item: function(e){

      e.preventDefault();
      if(!$('#id_barang').val()){
        alert('Kolom Barang Tidak Boleh Kosong');
        return false;
      }

      if(!$('#qty').val()){
        alert('Qty Tidak Boleh Kosong');
        return false;
      }

      if(!$('#harga').val()){
        alert('Harga Tidak Boleh Kosong');
        return false;
      }

      let qty       = $('#qty').val();
      let harga     = $('#harga').val();
      let id_barang = $('#id_barang').val();
      let nama      = $('#id_barang option:selected').attr('data-nama');
      // var hasil   = barang.split('/');
      // let id_barang   = hasil[0];
      // let kd_barang = hasil[1];
      // let nama_barang = hasil[2];
      let id      = parseInt($('#id').val());
      var jumlah    = id + 1;
      $('#id').val(jumlah);

      if(id_barang){
        data = {
          qty       : qty,
          harga     : harga,
          id_barang : id_barang,
          nama      : nama,
          jumlah    : jumlah
        };

      }

      APL.Brg._addtogrid(data);
      APL.Brg._clearitem();
      // APL.Brg._focusadd();

    },

    _addtogrid: function(data){
      let grids = this.grids;
      let exist = APL.Brg.grids.row('#'+data.id_barang).index();
      //
      $('#id').val(data.id_barang);

      data.act = '<button item-code="'+data.id_barang+'" onclick="return APL.Brg._removefromgrid(this);">x</button>';
      data.DT_RowId = data.id_barang;
      //
      if(exist===undefined){
        grids.row.add(data).draw();
      }else{ 
        data.qty              = parseInt(grids.row(exist).data().qty) + parseInt(data.qty);
        grids.row(exist).data(data).draw(false);
      }

      if(this.no_ajax) return false;
      $.ajax({
        url: APL.baseUrl+'pesan/add_item',
        type : "POST",
        data: {         
          qty           : data.qty,
          harga         : data.harga,
          id_barang     : data.id_barang,
          nama          : data.nama,
          id            : data.jumlah
        }
      });
    },

    _set_items: function(items){
      this.no_ajax = true;
      //
      if(items) items = JSON.parse(items);
      this.items = items;
      items.map(function(i,e){
        var data = {
          qty       : i.qty,
          harga     : i.harga,
          id_barang : i.id_barang,
          nama      : i.nama
        };
        APL.Brg._addtogrid(data);
      });
      this.no_ajax = false;

    },

    _clearitem: function(){
      $('#qty').val('');
      $('#harga').val('');
      $('#id_barang').val('').trigger('change');
    },

    _removefromgrid: function(el){
      let code = $(el).attr('item-code');
      APL.Brg.grids.row("#"+code).remove().draw();
      $.ajax({
        type  : "GET",
        url   : APL.baseUrl+'pesan/remove_item',
        data  : {
          index_code: code
        }
      });
      return false;
    },

    save: function(e){
      e.preventDefault();

      $('.notif').hide();

      if($('#tgl').val()==''){
        $('#notif_tgl').show();
        $('#tgl').focus();
        return false;
      }
      if($('#no_ktp').val()==''){
        $('#notif_no_ktp').show();
        $('#no_ktp').focus();
        return false;
      }
      
      $.ajax({       
        data: {
          tgl           : $('#tgl').val(),
          no_ktp        : $('#no_ktp').val(),
          keterangan    : $('#keterangan').val(),
          no_pesan      : $('#no_pesan').val()
        },     
        type : "POST",        
        url: APL.baseUrl+'pesan/edit_save',
        success : function(resp){
          
          if(resp.nomor_dok == 'ERROR INSERT' || resp.nomor_dok == false) {
            alert("Data Gagal Disimpan");
            return false;
          }else {
            alert("Data Berhasil di Simpan ");

            // setTimeout(function () {
            //   window.location.href = APL.baseUrl+'pesan/'; //will redirect to google.
            // }, 2000);
          }
        }
      })
    }

  };

APL.Brg.init();
</script>
