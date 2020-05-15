<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>mc.Gaming-Force.es</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo env('APP_URL');?>/assets/adminlte2/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo env('APP_URL');?>/assets/adminlte2/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo env('APP_URL');?>/assets/adminlte2/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo env('APP_URL');?>/assets/adminlte2/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo env('APP_URL');?>/assets/adminlte2/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  
  <script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>
  
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.all.min.js"></script>
  
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition sidebar-mini skin-black layout-top-nav">
<div class="wrapper" >

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo env('APP_URL');?>" class="navbar-brand" style="color:white">mc.Gaming-Force.es</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo env('APP_URL');?>">Inicio <span class="sr-only">(current)</span></a></li>
            <li><a href="https://foro.gaming-force.es      ">Foro</a></li>
            <li><a href="<?php echo env('APP_URL');?>/tienda">Tienda</a></li>
            <li><a href="<?php echo env('APP_URL');?>/bans">Bans</a></li>
            
            <?php
            if($user != null):?>
            
            <?php $rango = $user->getRank();?>
            
                <?php if($rango['grupo'] == "DEV"):?>
                <li><a href="#" onclick="window.open('https://panel.mc.gaming-force.es:4430/','_blank');">Panel SERVS</a></li>
                <?php endif;?>
            <?php endif;?>
            
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- /.messages-menu -->


            
                <?php if(!is_null($user)):?>
            
<li  style="border-left:0px solid white !important;" >
            <a class="nav-link"  style="border-left:0px solid white !important;"  data-toggle="dropdown" href="#" onclick="window.location='<?php echo env('APP_URL');?>/notificaciones'" aria-expanded="false">
           <i class="fa fa-bell-o"></i>
          <span id="fondo_notificacion" style="visibility: hidden;" class="badge bg-yellow navbar-badge"><div id="notificaciones_count"></div></span>
        </a>
        </li>
            
            <li> <a style="border-left:0px solid white !important;" href="<?php echo env('APP_URL');?>/perfil"><img src="https://cravatar.eu/helmavatar/<?php echo $user->nick;?>/190.png" style="margin-right: 10px;width: 20px;"><?php echo $user->nick;?></a></li>
                <?php else : ?>
                <li><a  style="border-left:0px solid white !important;" href="<?php echo env('APP_URL');?>/login">Login</a></li>
                <?php endif;?>
                
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
      
      <style>

                    .box-solid {
            background-color:#FFF;
            box-shadow: 0px 2px 5px 0px;
            border-radius: 0px !important;
            background-color:#FFF;
            box-shadow: 0px 2px 5px 0px;

            }
            
            .box-header{
                text-align: center;
                overflow: hidden;
                background-color:rgb(234, 110, 110);
                font-family: "Lato",sans-serif;

            color:#FFF;
            padding: 13px;
             width: 100%;
             
             
}

h3{
    font-family: "Lato",sans-serif !important;
}

.navbar{
    background-color: #ca1600 !important;
}
            
.nav > li >  a {
    color:white !important;
}

.nav > li :active {
    background: none !important;
}
.nav > li >  a:active {
  background: none !important;
}

.nav > li >  a:focus {
  background: none !important;
}
.nav > li >  a:hover {
    background: rgb(234,110,110) !important;
}

.navbar-nav > li > a {
    border-right: 0px solid white !important;
}

.navbar-brand
{
   border-right:  0px solid black !important;
}

          
      </style>
  </header>