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
          
<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><b>CAMBIAR CONTRASEÑA</b></h3>


        </div>
        <div class="box-body">
                   
        <div class="form-group">
        <label for="exampleInputEmail1">Contraseña nueva</label>
        <input type="password" class="form-control" id="nueva">
        </div> 
        <div class="form-group">
        <label for="exampleInputEmail1">Contraseña nueva otra vez</label>
        <input type="password" class="form-control" id="nueva2">
        </div>                   

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="row">
                
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-2">
                    
                </div> 
                <div class="col-md-2">
                    
                </div>                 
                <div class="col-md-2">
                    <button type="button" class="btn btn-block btn-danger" onclick="EnviarCambio();">APLICAR</button>
                </div>                
                
                
            </div>
        </div>
        <!-- /.box-footer-->
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
                var nueva = document.getElementById("nueva");  
                var nueva2 = document.getElementById("nueva2");  
        
        $(document).ready(function() {

            ObtenerNotificacionesCount();
            
        }); 



     function EnviarCambio()
        {   
            

            if(nueva.value == nueva2.value && nueva.value != "" && nueva.value != null)
            {
                
                $.ajax({
                        url: '<?php echo env('APP_URL');?>/api/user/updatepassword/' + nueva.value,
                        type: 'get',
                        dataType : 'JSON',
                        success: function( response){

                            Swal.fire({
                            title: 'Contraseña cambiada',
                             text: "Tu contraseña ha sido modificada, vas a ser desconectado de la web y tendrás que conectarte con los nuevos datos",
                             type: 'success',
                             showCancelButton: false,
                             confirmButtonText: 'Desconectar'
                           }).then((result) => {
                             if (result.value) {
                                 window.location='<?php echo env('APP_URL');?>/logout';
                             }
                           })  

                        },
                        error: function( response ){
                            console.log("error");
                        }
                    });
            }
            else
            {
                            Swal.fire({
                            title: 'Error',
                             text: "Las contraseñas no coinciden o no son válidas",
                             type: 'error',
                             showCancelButton: false,
                             confirmButtonText: 'Reintentar'
                           }).then((result) => {
                             if (result.value) {
                                 window.location='<?php echo env('APP_URL');?>/perfil/cambiarcontrasenya';
                             }
                           })  
            }
 
        }

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