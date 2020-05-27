
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">

  <title>PT. NRI GLOBAL MANDIRI</title>

  <!-- Bootstrap CSS -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="<?php echo base_url(); ?>assets/css/elegant-icons-style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom styles -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">
</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" action="<?php echo base_url(); ?>" autocomplete="off" method="post" accept-charset="utf-8">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" placeholder="Username" name="username" required>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <?php echo $this->session->flashdata('msg'); ?>
        <!-- button class="btn btn-info btn-lg btn-block" type="submit">Signup</button> -->
      </div>
    </form>
  </div>


</body>

</html>
