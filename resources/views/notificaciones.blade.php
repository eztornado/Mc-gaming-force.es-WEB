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
      <!-- Default box -->
      <div class="box box-solid">

        <div class="box-header">
                  <h3 class="card-title">NOTIFICACIONES</h3>

                </div>          
        <div class="box-body">
            
            <div id="notificaciones">
                
            </div>

        </div>
        <!-- /.card-body -->

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  

  
  
@include('comun.footer_landing')  

</div>

    <script>

        
    </script>

@stop

@section('footer')
    @include('comun.scripts_landing')
    
    <script>
        
        var notificaciones = document.getElementById("notificaciones");
        var notificaciones_count = document.getElementById("notificaciones_count");
        var fondo_notificacion = document.getElementById("fondo_notificacion");        


        
        $(document).ready(function() {

            ObtenerNotificaciones();
            ObtenerNotificacionesCount();
        }); 
        
        
        
        function DibujarNotificaciones(item, index)
        {
            var notificacion = '';
            
            if(item.fixed == 1)
            {
                if(item.type == 'danger')
                {
                    notificacion = "<div class=\"callout callout-"+item.type+"\"><h5>" + item.texto + "</h5></div>";
                }
                else if(item.type == 'warning')
                {
                    notificacion = "<div class=\"callout callout-"+item.type+"\"><h5>" + item.texto + "</h5></div>";
                }

                else if(item.type == 'success')
                {
                    notificacion = "<div class=\"callout callout-"+item.type+"\"><h5>" + item.texto + "</h5></div>";
                }    
                else if(item.type == 'info')
                {
                    notificacion = "<div class=\"callout callout-"+item.type+"\"><h5>" + item.texto + "</h5></div>";
                }                    
                
            }
            else if(item.fixed == 0)
            {
                if(item.type == 'danger')
                {
                    notificacion = "<div class=\"alert alert-"+item.type+" alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\" onclick=\"Visto('"+item.id+"')\">×</button><h5><i class=\"icon fa fa-ban\"></i>" +  item.texto + "</h5></div>";
                }
                else if(item.type == 'warning')
                {
                    notificacion = "<div class=\"alert alert-"+item.type+" alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\" onclick=\"Visto('"+item.id+"')\" >×</button><h5><i class=\"icon fa fa-exclamation-triangle\"></i>" +  item.texto + "</h5></div>";
                }

                else if(item.type == 'success')
                {
                    notificacion = "<div class=\"alert alert-"+item.type+" alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\" onclick=\"Visto('"+item.id+"')\" >×</button><h5><i class=\"icon fa fa-check\"></i>" +  item.texto + "</h5></div>";
                }  
                else if(item.type == 'info')
                {
                    notificacion = "<div class=\"alert alert-"+item.type+" alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\" onclick=\"Visto('"+item.id+"')\" >×</button><h5><i class=\"icon fa fa-info\"></i>" +  item.texto + "</h5></div>";
                }                  
                
                
            }
            
            notificaciones.innerHTML = notificaciones.innerHTML + notificacion;
        }
        
        
        
        

                
        
        function ObtenerNotificaciones()
        {   
            

            notificaciones.innerText = "";
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/notificaciones',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                        if(response.length > 0)
                        {
                            response.forEach(DibujarNotificaciones);
                        }
                        else
                        {
                            notificaciones.innerHTML='</br><p>No hay notificaciones</p></br>';
                        }
                        
                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerNotificaciones, 60000);    
        }
        
        function Visto(id)
        {   
            

            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/notificaciones/' + id,
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        

                    window.location='<?php echo env('APP_URL');?>/notificaciones';
                        
                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                

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