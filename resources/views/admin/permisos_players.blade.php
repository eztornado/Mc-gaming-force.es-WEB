@extends('layouts.layout')

@section('header')
    @include('comun.navbar_landing')
    
    <style>
        .swal2-title
        {
            display: block !important;
        }
    </style>    

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
                    <a href="#">USUARIOS DE PERMISOS</a>
                </li>                
            </ol>   
    
    
    <div class="row">

        
        <div class="box">

                <div class="box-body">

              <table  id="tabla" name="tabla" class="table table-striped">
                <thead><tr>
                  <th>ID</th>      
                  <th>CARA</th>
                   <th>USUARIO</th>
                  <th>PRIMARY_GROUP</th>
                  <th>CAMBIAR</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($players as $u):?>
                
                    <td>
                        <?php echo $u->id;?>
                    </td>    
                    <td>
                        <img src="https://cravatar.eu/helmavatar/<?php echo $u->username;?>/190.png" style="margin-right: 10px;width: 20px;">
                    </td>
                    <td>
                        <?php echo $u->username;?>
                    </td> 
                    <td>
                        <?php echo $u->primary_group;?>
                    </td>   
                    <td>
                        <button type="button" class="btn btn-block btn-primary" onclick="Actualizar('<?php echo $u->username;?>')">Cambiar</button>
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


     function Actualizar(nombre)
     {
         

                        Swal.fire({
                 title: 'Vas a cambiar al usuario <strong>' + nombre +'</strong> de grupo PRINCIPAL (SOLO SE DEBE TENER CON GRUPO PRINCIPAL != USER A STAFF',
                 type: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                html:
                   '</br></br>, ' +
                   'Nuevo Grupo :  ' +
                   '<select class="form-control" id="select_grupos"><option value="user">user</option><option value="vip">vip</option><option value="mod">mod</option><option value="maper">maper</option><option value="admin">admin</option><option value="root">root</option></select>' +
                   '</br></br>, ' ,           
                 confirmButtonText: 'Cambiar'
               }).then((result) => {
                 if (result.value) {
                     
                      var select_grupos = document.getElementById("select_grupos");  
                      window.location='<?php echo env('APP_URL');?>/admin/permisos_players/actualizar/' + nombre + '/grupo/' + select_grupos.value ;

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