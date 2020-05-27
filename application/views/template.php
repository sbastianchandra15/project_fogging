<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>SISTEM PERSEDIAAN BARANG PT. NRI GLOBAL MANDIRI</title>

  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/select2.css" rel="stylesheet" type="text/css" >
  <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/datatables.min.css" rel="stylesheet" type="text/css" >
  <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" >
  <link href="<?php echo base_url(); ?>assets/css/datepicker/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" >

  <!-- Harus pakai jquery-2.2.4.min.js kalau mau add new -->
  <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>

  <!-- notif dialog untuk save -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-dialog.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
  
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>


  <script>
      var APL = { baseUrl: '<?php echo base_url(); ?>' };

    </script>
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->

    <header class="header dark-bg hidden-print">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.html" class="logo">SISTEM PERSEDIAAN BARANG PT. NRI GLOBAL MANDIRI</a>
      <!--logo end-->

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">          

          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username"><?php echo $this->session->userdata('nama'); ?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li>
                <a href="<?php echo base_url().'logout' ?>"><i class="icon_key_alt"></i> Log Out</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse hidden-print">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i><span>Transaksi</span><span class="menu-arrow arrow_carrot-right"></span></a>
            <ul class="sub">
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>transaksi_masuk">Barang Masuk</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>transaksi_keluar">Barang Keluar</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>transaksi_returkeluar">Retur Barang Keluar</a></li>
              <!--<li><a class="dropdown-item" href="<?php //echo base_url(); ?>transaksi_mutasi">Mutasi Antar Gudang</a></li>-->
            </ul>
          </li>
          <?php 
            if($this->session->userdata('hak_akses')==1){
          ?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_table"></i><span>Master</span><span class="menu-arrow arrow_carrot-right"></span></a>
            <ul class="sub">
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>barang">Barang</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>toko">Toko</a></li>
              <!--<li><a class="dropdown-item" href="<?php echo base_url(); ?>supplier">Supplier</a></li>-->
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>user/view_user">User</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>gudang">Gudang</a></li>
            </ul>
          </li>
          <?php 
            }
          ?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_documents_alt"></i><span>Report</span><span class="menu-arrow arrow_carrot-right"></span></a>
            <ul class="sub">
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>pergerakan_stok">Pergerakan Stok</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>toko/report">Toko</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>barang/report">Barang</a></li>
            </ul>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <?php echo $contents; ?>
            
          </div>
        </div>
        <!-- page start-->
        <!-- Page content goes here -->
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  


</body>

</html>
