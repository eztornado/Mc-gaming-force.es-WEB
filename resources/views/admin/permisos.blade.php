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
                    <a href="#">PERMISOS DE GRUPOS</a>
                </li>                
            </ol>   
    

    
    
    <div class="row">

        
        <div class="box">

        <div class="box-header with-border">
            <button type="button" style="max-width:20%;" onclick="window.location='<?php echo env('APP_URL');?>/admin/permisos_de_grupo/add'" class="btn btn-block btn-primary">Crear Nuevo Permiso</button>


        </div>            
                <div class="box-body">

              <table  id="tabla" name="tabla" class="table table-striped">
                <thead><tr>
                  <th>ID</th>      
                  <th>NAME</th>
                  <th>PERMISSION</th>
                  <th>VALUE</th>                  
                  <th>SERVER</th>
                  <th>WORLD</th>
                  <th>EXPIRY</th>
                  <th>CONTEXTS</th>
                  <th>ELIMINAR</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach($permisos as $u):?>
                
                    <td>
                        <?php echo $u->id;?>
                    </td>    
                    <td>
                        <?php echo $u->name;?>
                    </td>   
                    <td>
                        <?php echo $u->permission;?>
                    </td>                       
                          
                    <td>
                        <?php echo $u->value;?>
                    </td>     
                    <td>
                        <?php echo $u->server;?>
                    </td>      
                    <td>
                        <?php echo $u->world;?>
                    </td> 
                    <td>
                        <?php echo $u->expiry;?>
                    </td>       
                    <td>
                        <?php echo $u->contexts;?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-block btn-danger" onclick="Eliminar('<?php echo $u->id;?>')">Eliminar</button>
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
        
     function Eliminar(id)
     {
         
                    Swal.fire({
             title: '<strong>¿Seguro que quieres borrar esto?</strong>',
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Eliminar'
           }).then((result) => {
             if (result.value) {
                  window.location='<?php echo env('APP_URL');?>/admin/permisos_de_grupo/eliminar/' + id;
               Swal.fire(
                 'Eliminado el permiso!',
                 'Tu permiso ha sido eliminado.',
                 'success'
               )
             }
           })
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