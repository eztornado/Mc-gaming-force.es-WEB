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
                    <a href="<?php echo env('APP_URL');?>/admin/permisos_de_grupo/">PERMISOS DE GRUPOS</a>
                </li>      
                
                <li class="breadcrumb-item">
                    <a href="#">AÑADIR PERMISO</a>
                </li>                      
            </ol>   
    
    
    <div class="row">

        
        <div class="box">

                <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Grupo</label>
                  <input type="text" class="form-control" id="grupo_permiso">
                </div>
                    
                <div class="form-group">
                  <label for="exampleInputEmail1">Nodo de Permiso</label>
                  <input type="text" class="form-control" id="nodo_permiso">
                </div> 
                    
                <div class="form-group">
                  <label for="exampleInputEmail1">Value</label>
                  <input type="text" class="form-control" value="1" id="value">
                </div>   
                    
                <div class="form-group">
                  <label for="exampleInputEmail1">Server</label>
                  <input type="text" class="form-control" value="global" id="server">
                </div>
                    
                <div class="form-group">
                  <label for="exampleInputEmail1">World</label>
                  <input type="text" class="form-control" value="global" id="world">
                </div>                      
                    

                </div>
                <!-- /.box-body -->
            <div class="box-footer">
                <button onclick="guardar()" class="btn btn-primary">Guardar</button>
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
        
        
     function guardar()
     {
         
            var grupo_permiso = document.getElementById("grupo_permiso");   
            var nodo_permiso = document.getElementById("nodo_permiso");   
            var value = document.getElementById("value");  
            var server = document.getElementById("server");
            var world = document.getElementById("world");
            
            $.ajax({
           url: '<?php echo env('APP_URL');?>/admin/permisos_de_grupo/add/'+grupo_permiso.value+'/'+nodo_permiso.value+'/'+value.value+'/'+server.value+'/'+world.value,
           type: 'get',
           dataType : 'JSON',
           success: function( response){

                    Swal.fire({
             title: '<strong>El permiso ha sido insertado</strong>',
             type: 'success',
             showCancelButton: false,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Recargar'
           }).then((result) => {
             if (result.value) {
                 window.location.reload();
             }
           })


           },
           error: function( response ){
               console.log("error");
           }
       });
                
     }
     
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