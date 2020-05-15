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
            <h3 class="box-title"><b>HISTÓRICO DE PRODUCTOS PEDIDOS</b></h3>


        </div>
        <div class="box-body">
            
<div class="box-body no-padding">
              <table class="table table-striped">
                <tbody><tr>
                  <th>PRODUCTO</th>      
                  <th>PROCESADO</th>
                  <th>FECHA COMPRA</th>
                </tr>

                <?php foreach($historico as $h):?>
                <tr>
                    <td>
                        <?php echo $h->nombre;?>
                    </td>                    
                    <td>
                        <?php echo $h->estado;?>
                    </td>
                    <td>
                        <?php echo $h->created_at;?>
                    </td>
                
                </tr>
                <?php endforeach;?>                
                
                
              </tbody></table>
            </div>            

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="row" style="padding:20px;">
              
                <div class="col-md-2">
                    <button type="button" onclick="window.location='<?php echo env('APP_URK');?>/perfil/'" class="btn btn-block btn-danger">Volver</button>
                </div>
                <div class="col-md-8">
                </div>
                <div class="col-md-2">
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