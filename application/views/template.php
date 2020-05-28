<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Data Table | Adminpro - Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/adminpro-custon-icon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/data-table/bootstrap-editable.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/c3.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
    <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="materialdesign">
    <div class="wrapper-pro">
        <div class="left-sidebar-pro">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3><?php echo $this->session->userdata('username'); ?></h3>
                    <p>Developer</p>
                    <strong>AP+</strong>
                </div>
                <div class="left-custom-menu-adp-wrap">
                    <ul class="nav navbar-nav left-sidebar-menu-pro">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>"  role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-home"></i> <span class="mini-dn">Admin</span> </a>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-envelope"></i> <span class="mini-dn">Mailbox</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="inbox.html" class="dropdown-item">Inbox</a>
                                <a href="view-mail.html" class="dropdown-item">View Mail</a>
                                <a href="compose-mail.html" class="dropdown-item">Compose Mail</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-flask"></i> <span class="mini-dn">Interface</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="google-map.html" class="dropdown-item">Google Map</a>
                                <a href="data-maps.html" class="dropdown-item">Data Maps</a>
                                <a href="pdf-viewer.html" class="dropdown-item">Pdf Viewer</a>
                                <a href="x-editable.html" class="dropdown-item">X-Editable</a>
                                <a href="code-editor.html" class="dropdown-item">Code Editor</a>
                                <a href="tree-view.html" class="dropdown-item">Tree View</a>
                                <a href="preloader.html" class="dropdown-item">Preloader</a>
                                <a href="images-cropper.html" class="dropdown-item">Images Cropper</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Header top area start-->
        <div class="content-inner-all">
            <div class="header-top-area">
                <div class="fixed-header-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="admin-logo logo-wrap-pro">
                                    <a href="#"><img src="img/logo/log.png" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12"></div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                <span class="admin-name">Advanda Cro</span>
                                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                              <li><a href="#"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="breadcome-area mg-b-10 small-dn"></div>

            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="dashboard.html">Dashboard v.1</a>
                                                </li>
                                                <li><a href="dashboard-2.html">Dashboard v.2</a>
                                                </li>
                                                <li><a href="analytics.html">Analytics</a>
                                                </li>
                                                <li><a href="widgets.html">Widgets</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="inbox.html">Inbox</a>
                                                </li>
                                                <li><a href="view-mail.html">View Mail</a>
                                                </li>
                                                <li><a href="compose-mail.html">Compose Mail</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 des-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcome-heading"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                            <li><span class="bread-blod">Dashboard</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcome End-->
            <!-- Static Table Start -->
            <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1>Projects <span class="table-project-n">Data</span> Table</h1>
                                        <div class="sparkline13-outline-icon">
                                          <ul class="breadcome-menu">
                                            <li>Input</li>
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="sparkline13-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                        <table id="table" data-toggle="table" data-pagination="true" data-search="true">
                                            <thead>
                                                <tr>
                                                    <th >ID</th>
                                                    <th >Project</th>
                                                    <th >Email</th>
                                                    <th >Phone</th>
                                                    <th >Company</th>
                                                    <th >Completed</th>
                                                    <th >Task</th>
                                                    <th >Date</th>
                                                    <th >Price</th>
                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Web Development</td>
                                                    <td>admin@uttara.com</td>
                                                    <td>+8801962067309</td>
                                                    <td>Aber Ltd.</td>
                                                    <td class="datatable-ct"><span class="pie">1/6</span>
                                                    </td>
                                                    <td>10%</td>
                                                    <td>Jul 14, 2018</td>
                                                    <td>$5455</td>
                                                    <td class="datatable-ct"><i class="fa fa-check"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Graphic Design</td>
                                                    <td>fox@itpark.com</td>
                                                    <td>+8801762067304</td>
                                                    <td>Abitibi Inc.</td>
                                                    <td class="datatable-ct"><span class="pie">230/360</span>
                                                    </td>
                                                    <td>70%</td>
                                                    <td>fab 2, 2018</td>
                                                    <td>$8756</td>
                                                    <td class="datatable-ct"><i class="fa fa-check"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Software Development</td>
                                                    <td>gumre@hash.com</td>
                                                    <td>+8801862067308</td>
                                                    <td>Acambis plc</td>
                                                    <td class="datatable-ct"><span class="pie">0.42/1.461</span>
                                                    </td>
                                                    <td>5%</td>
                                                    <td>Seb 5, 2018</td>
                                                    <td>$9875</td>
                                                    <td class="datatable-ct"><i class="fa fa-check"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Woocommerce</td>
                                                    <td>kyum@frok.com</td>
                                                    <td>+8801962066547</td>
                                                    <td>ACLN Ltd.</td>
                                                    <td class="datatable-ct"><span class="pie">2,7</span>
                                                    </td>
                                                    <td>15%</td>
                                                    <td>Oct 10, 2018</td>
                                                    <td>$3254</td>
                                                    <td class="datatable-ct"><i class="fa fa-check"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Static Table End -->
        </div>
    </div>
    <!-- jquery
    ============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.meanmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.sticky.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/counterup/waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/peity/peity-active.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sparkline/sparkline-active.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/tableExport.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/data-table-active.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table-editable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-editable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/colResizable-1.5.source.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table-export.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>


</body>

</html>