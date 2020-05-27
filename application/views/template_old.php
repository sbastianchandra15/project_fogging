<?php 
if($this->session->userdata('loginuser')==1){
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.png"> -->
    <title>Aplikasi Persediaan barang</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-dialog.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/helper.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/media.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/xp.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/datatables.min.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/select2.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/datepicker/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" >
    <!-- <script src="assets/js/jquery.ba-throttle-debounce.js"></script>     -->

    <script src="<?php echo base_url(); ?>assets/js/modernizr-2.5.3.js"></script>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/date.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-dialog.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/keypress-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.tabbable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.bestupper.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.id.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/session.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
    <script>
      var APL = { baseUrl: '<?php echo base_url(); ?>' };

    </script>

  </head>
  <body class="home home_index">
    <noscript>Aplikasi ini tidak bisa dijalankan karena JavaScript tidak aktif</noscript>
    <div class="app">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a tabindex="-1" class="navbar-brand" href="<?php echo base_url(); ?>">Persediaan barang</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <div class="nav-date hidden-xs"><?php echo indonesian_date(dbnow(),'d F Y','') ?></div>
      <ul class="nav navbar-nav pull-left">
        <li class="dropdown"><a tabindex="1" class="dropdown-toggle" keypress="alt t" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><u>T</u>ransaksi<span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>transaksi_masuk">Barang Masuk</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>transaksi_keluar">Barang Keluar</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>transaksi_returkeluar">Retur Barang Keluar</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>transaksi_mutasi">Mutasi Antar Gudang</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>production">Production</a></li>
          </ul>
        <?php 
        if($this->session->userdata('hak_akses')==1){
        ?>
        <li class="dropdown"><a tabindex="1" class="dropdown-toggle" keypress="alt m" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><u>M</u>aster<span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>barang">Barang</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>customer">Customer</a></li>
			<li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>supplier">Supplier</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>user/view_user">User</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>gudang">Gudang</a></li>
          </ul>
        <?php 
        }
        ?>
        <li class="dropdown"><a tabindex="1" class="dropdown-toggle" keypress="alt r" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><u>R</u>eport<span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>pergerakan_stok">Pergerakan Stok</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>customer/report">Customer</a></li>
            <li><a tabindex="2" class="dropdown-item" href="<?php echo base_url(); ?>barang/report">Barang</a></li>
            
          </ul>
      	<?php
   //    	foreach ($this->session->userdata('menus') as $key => $val) {
   //    		echo '<li class="dropdown"><a tabindex="1" class="dropdown-toggle" keypress="'.$val->keypress.'" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$val->nama.' <span class="caret"></span></a>';
			// $res 	= array();
  	// 		foreach ($this->session->userdata('submenu') as $key => $valsub) {
  	// 		$res[$valsub->id_submenu][]=$valsub;
  	// 		}
  	// 		echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
  	// 		foreach ($res[$val->id] as $key => $value) {
  	// 		echo '<li><a tabindex="2" class="dropdown-item" href="'.base_url().''.$value->url.'">'.$value->nama.'</a></li>';
  	// 		}
  	// 		echo '</ul>';
   //    	}
      	?>    
      </ul>
      <ul class="nav navbar-nav navbar-right hidden-xs">
        <li>
          <div class="nav-user">Anda Login Sebagai : <?php echo $this->session->userdata('nama'); ?> (<?php echo ($this->session->userdata('hak_akses')==1)? 'Super Admin' : 'Admin Gudang'; ?>)</div>
        </li>
        <li>
          <a class="nav-out" href="<?php echo base_url(); ?>logout"><span class="hidden-sm">Keluar </span><i class="fa fa-power-off" aria-hidden="true"></i></a>
        </li>
      </ul>

    </div>
  </div><!-- container -->
</nav>
<div id="content" class="container">
<?php echo $contents; ?>
</div>
	<footer class="footer">
    <div class="container">
			<div class="version hidden-xs">
	      Versi 1.0	    </div>
	    <div class="copyright">Hak Cipta CV Langgeng Jaya&copy; 2017</div>
    </div>
  </footer>
	<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
  <script>
    var keylistener = new window.keypress.Listener();
    $('a[keypress], button[keypress]').map(function(idx,elm){
      var self = this, doit = function(){ $(self)[0].click(); };
      if(self.hasAttribute('sequence')){ keylistener.sequence_combo(elm.attributes['keypress'].value, doit);
      }else{ keylistener.simple_combo( elm.attributes['keypress'].value, doit); }
    });
  </script>
	<div id="debug"></div>
	<script>
		// POS5.date_format = 'DD MMMM YYYY';
		// POS5.currentUrl = 'http://localhost/pos5sp/';
	</script>
	<script src='http://localhost/pos5sp/assets/js/codeigniter-csrf.js' type='text/javascript'></script>
	</div><!-- .app -->
</body>
</html>
<?php 
}else{
  redirect('user');
}
?>