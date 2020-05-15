 

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" <?php //style="background: url('https://i.pinimg.com/originals/47/d8/7f/47d87f6e9d2e7eb2110dd95f73946172.jpg') repeat; background-size: 60px;" ?>>
    <!-- Brand Logo --> 
    <a href="index3.html" class="brand-link">
        
      <span class="brand-text font-weight-light">mc.Gaming-Force.es</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" >
          
          <div class="row">
              <div class="col-md-4">
                  <img src="https://cravatar.eu/helmavatar/<?php echo $user->nick;?>/190.png" style="margin-right: 10px;width: 40px;">
              </div>
              <div class="col-md-8">
                  <div class="row">
                      <a href="#" class="d-block" style="font-family: 'Press Start 2P';color:white;"><?php echo $user->nick;?></a>
                  </div>
                  <div id="rango_sidebar" class="row">

                  </div>                  
                  
              </div>              
              
              
          </div>
          
          



      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">PANEL DE USUARIO</li>
          <li class="nav-item">
            <a href="<?php echo env('APP_URL');?>/perfil" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Mi Perfil
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li> 
          <li class="nav-item">
            <a href="<?php echo env('APP_URL');?>/tienda" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tienda
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>  
          
  
          
         
          
          <li class="nav-header">ADMINISTRACIÓN</li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Buscar Pefil
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>  
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Permisos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li> 
        
          


 


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
ñ