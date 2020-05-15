  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" onclick="window.location = '<?php echo env('APP_URL');?>'" data-slide="true" href="#">
          Inicio
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" onclick="window.location = 'https://foro.gaming-force.es'" data-slide="true" href="#">
          Foro
        </a>     
      </li>
      <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" onclick="window.location = '<?php echo env('APP_URL');?>/bans'" data-slide="true" href="#">
          Bans
        </a>
      </li>   
      <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" onclick="window.location = '<?php echo env('APP_URL');?>/estado_red'" data-slide="true" href="#">
         Estado Red
        </a>
      </li>      

    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" onclick="window.location = '<?php echo env('APP_URL');?>/logout'" data-slide="true" href="#">
          Desconectar
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->