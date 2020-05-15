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
          <div class="row">
<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Pago Validado!</h4>
                Tu pago mediante Paypal ha sido válidado con éxito. Ya puedes ir a la tienda y disfrutar de tus MineCoins adquiridos
              </div>   
              
              
          </div>
          
          <div class="row">
              <div class="col-md-3">
                  <button type="button" onclick="window.location='<?php echo env('APP_URL');?>/tienda' "class="btn btn-block btn-danger">Ir a la Tienda</button>
              </div>
              <div class="col-md-3">
              </div>   
              <div class="col-md-3">
              </div> 
              <div class="col-md-3">
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
