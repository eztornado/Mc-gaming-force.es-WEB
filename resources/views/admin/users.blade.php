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
                    <a href="<?php echo env('APP_URL');?>/admin/panel">ADMINISTRACIÓN GENERAL</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="#">USERS</a>
                </li>                
            </ol>   
    
    
    <div class="row">

        
        <div class="box">

                <div class="box-body">

              <table  id="tabla" name="tabla" class="table table-striped">
                <thead><tr>
                  <th>ID</th>      
                  <th>CARA</th>
                  <th>NICK</th>
                  <th>UUID</th>                  
                  <th>FIRSTIP</th>
                  <th>LASTIP</th>
                  <th>CREATED_AT</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $u):?>
                
                    <tr onclick="window.location = '<?php echo env('APP_URL');?>/admin/perfil/<?php echo $u->id;?>'">
                    <td>
                        <?php echo $u->id;?>
                    </td>    
                    <td>
                        <img src="https://cravatar.eu/helmavatar/<?php echo $u->nick;?>/190.png" style="margin-right: 10px;width: 20px;">
                    </td>
                    <td>
                        <?php echo $u->nick;?>
                    </td>   
                    <td>
                        <?php echo $u->uuid;?>
                    </td>                       
                          
                    <td>
                        <?php echo $u->firstIP;?>
                    </td>     
                    <td>
                        <?php echo $u->lastIP;?>
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
             $('#tabla').DataTable();
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