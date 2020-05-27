
<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.png"> -->
    <title>Sales Tracking</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-dialog.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/helper.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/media.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/xp.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" type="text/css" >
    <!-- <script src="assets/js/jquery.ba-throttle-debounce.js"></script>     -->
    <script src="<?php echo base_url(); ?>assets/js/modernizr-2.5.3.js"></script>
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
      <a tabindex="-1" class="navbar-brand" href="<?php echo base_url(); ?>">Sales Tracking</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <div class="nav-date hidden-xs"><?php echo indonesian_date(dbnow(),'d F Y','') ?></div>
      <ul class="nav navbar-nav pull-left">
      	<?php
      	foreach ($this->session->userdata('menus') as $key => $val) {
      		echo '<li class="dropdown"><a tabindex="1" class="dropdown-toggle" keypress="'.$val->keypress.'" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$val->nama.' <span class="caret"></span></a>';
			$res 	= array();
  			foreach ($this->session->userdata('submenu') as $key => $valsub) {
  			$res[$valsub->id_submenu][]=$valsub;
  			}
  			echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
  			foreach ($res[$val->id] as $key => $value) {
  			echo '<li><a tabindex="2" class="dropdown-item" href="'.base_url().'content/'.$value->url.'">'.$value->nama.'</a></li>';
  			}
  			echo '</ul>';
      	}
      	?>    
      </ul>
      <ul class="nav navbar-nav navbar-right hidden-xs">
        <li>
          <div class="nav-user"><?php echo $this->session->userdata('nama'); ?></div>
        </li>
        <li>
          <a class="nav-out" href="<?php echo base_url(); ?>logout"><span class="hidden-sm">Keluar </span><i class="fa fa-power-off" aria-hidden="true"></i></a>
        </li>
      </ul>

    </div>
  </div><!-- container -->
</nav>
<div id="content" class="container">
<?php 
include 'content.php';
?>
<?php
	// test($this->session->userdata('menus'),1);
?>
</div>
	<footer class="footer">
    <div class="container">
			<div class="version hidden-xs">
	      Versi 5.0	    </div>
	    <div class="copyright">Hak Cipta &copy; 2017</div>
    </div>
  </footer>
	<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
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

	<div id="debug"></div>
	<script>
		// POS5.date_format = 'DD MMMM YYYY';
		// POS5.currentUrl = 'http://localhost/pos5sp/';
	</script>
	<script src='http://localhost/pos5sp/assets/js/codeigniter-csrf.js' type='text/javascript'></script>
	</div><!-- .app -->
</body>
</html>
