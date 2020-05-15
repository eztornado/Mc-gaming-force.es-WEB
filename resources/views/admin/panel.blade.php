@extends('layouts.layout')

@section('header')
    @include('comun.navbar_landing')
    

@stop

@section('body')


  <div class="content-wrapper" style="background: url('<?php echo env('APP_URL');?>/assets/imagenes/background.jpg') center center/cover no-repeat;">
    <div class="container" >
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content">
          
<div class="container">



    
<ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">ADMINISTRACIÓN GENERAL</a>
                </li>
            </ol>   
    
    
    <div class="row">
        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/users' ">
                        <div class="inner">
                            <h4><b>USUARIOS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-users"></i>
                        </div>

                      </div>
            
           <?php /* <div class="small-box bg-aqua" style="min-height: 110px;">
                        <div class="inner">
                            <h4><b>TIENDAS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>            */?>
        </div>
        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/pedidos'">
                        <div class="inner">
                            <h4><b>PEDIDOS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>
        </div>
        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/bans'">
                        <div class="inner">
                            <h4><b>BANS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-minus-circle"></i>
                        </div>

                      </div>     
       
        </div>
                
        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/economy'">
                        <div class="inner">
                            <h4><b>ECONOMIA</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-eur"></i>
                        </div>

                      </div>     
       
        </div>
        
        
        
    </div>
    
<ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">PERMISOS</a>
                </li>
            </ol>   
    <div class="row">
        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/permisos_de_grupo'">
                        <div class="inner">
                            <h4><b>PERMISOS </br> DE GRUPOS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>   
           <?php /* <div class="small-box bg-red" style="min-height: 110px;">
                        <div class="inner">
                            <h4><b>BUNGEEPERMS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>    */?>           
                   

        </div>
        
        
        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/permisos_de_usuario'">
                        <div class="inner">
                            <h4 style="color: white;"><b>PERMISOS </br> DE USUARIO</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>  
            
           <?php /* <div class="small-box bg-red" style="min-height: 110px;">
                        <div class="inner">
                            <h4 style="color: white;"><b>BUNGEEPERMS </br> DE UN GRUPO</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>     */?>         
            

        </div>
        
        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/permisos_grupos'">
                        <div class="inner">
                            <h4 style="color: white;"><b>GRUPOS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>    
            
          <?php /*  <div class="small-box bg-red" style="min-height: 110px; ">
                        <div class="inner">
                            <h4 style="color: white;"><b>BUNGEEPERMS </br> DE UN USUARIO</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>       */?>           
            
            
        </div>

        <div class="col-md-3" style="margin-top: 15px;">
            <div class="small-box bg-red" style="min-height: 110px; cursor:pointer;" onclick="window.location='<?php echo env('APP_URL');?>/admin/permisos_players'">
                        <div class="inner">
                            <h4 style="color: white;"><b>USUARIOS</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>      

            <?php /*<div class="small-box bg-gray" style="min-height: 110px;">
                        <div class="inner">
                            <h4 style="color: white;"><b>BUNGEEPERMS </br> DE UN MUNDO</b></h4>

                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>

                      </div>      */?>            
                        

        </div>
        
     
        
        
        
    </div>  
   

 
        

    
</div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>

  

  
  
@include('comun.footer_landing')  

</div>



@stop

@section('footer')
    @include('comun.scripts_landing')
    
     <script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>
  
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        
                var notificaciones_count = document.getElementById("notificaciones_count");
        var fondo_notificacion = document.getElementById("fondo_notificacion");   
        
        $(document).ready(function() {

            ObtenerNotificacionesCount();
        }); 

     function ObtenerNotificacionesCount()
        {   
            

            notificaciones_count.innerText = "";
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/notificaciones',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                      if(response.length > 0)
                      {
                        fondo_notificacion.style.visibility = 'visible';  
                        notificaciones_count.innerHTML = '<b>' + response.length + '</b>';  
                      }
                      else
                      {
                          fondo_notificacion.style.visibility = 'hidden';
                      }
                        
                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerNotificacionesCount, 60000);    
        }
        

                
    </script>    
    

  
@stop