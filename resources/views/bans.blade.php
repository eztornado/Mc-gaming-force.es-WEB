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



    
 
    
    
    <div class="row">

        
        <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"><b>BANS</b></h3>


        </div>            
                <div class="box-body">

              <table  id="tabla" name="tabla" class="table table-striped">
                <thead><tr>
                  <th>ID</th>      
                  <th>CARA</th>
                  <th>USUARIO</th>
                  <th>TIPO</th>                
                  <th>MOTIVO</th>
                  <th>MENSAJE</th>
                  <th>DURACIÓN</th>
                  <th>STAFF CARA</th>
                  <th>STAFF NICK</th>
                  <th>FECHA EMISIÓN</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($bans as $u):?>
                
                    <td>
                        <?php echo $u->id;?>
                    </td>    
                    <td>
                        <img src="https://cravatar.eu/helmavatar/<?php echo $u->usuario_nombre;?>/190.png" style="margin-right: 10px;width: 20px;">
                    </td>
                    <td>
                        <?php echo $u->usuario_nombre;?>
                    </td>   
                    <td>
                        <?php echo $u->type;?>
                    </td>                     
                    <td>
                        <?php echo $u->reason;?>
                    </td>                       
                          
                    <td>
                        <?php echo $u->message;?>
                    </td>     
                    <td>
                        ----
                    </td>  
                    <td>
                        <img src="https://cravatar.eu/helmavatar/<?php echo $u->admin_nombre;?>/190.png" style="margin-right: 10px;width: 20px;">
                    </td>
                    <td>
                        <?php echo $u->admin_nombre;?>
                    </td>                       
                    <td>
                        <?php echo $u->created_at;?>
                    </td>   

                </tr>
                <?php endforeach;?>
                </tbody>
              </table>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
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
    

  
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        
                var notificaciones_count = document.getElementById("notificaciones_count");
        var fondo_notificacion = document.getElementById("fondo_notificacion");   
        
        $(document).ready(function() {

            ObtenerNotificacionesCount();
             $('#tabla').DataTable({
                "order": [[ 0, 'desc' ]]
            });
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