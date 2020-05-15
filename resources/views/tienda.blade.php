@extends('layouts.layout')

@section('header')
 @include('comun.navbar_landing')
    
    
    <style>
        
        .swal2-show{
width: 850px;
height: 450px;
}
#swal2-title{
    margin-top: -3%;
}
#swal2-icon{
    margin: 50px;
}

    </style>    

@stop

@section('body')



  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: url('<?php echo env('APP_URL');?>/assets/imagenes/background.jpg') center center/cover no-repeat; !important;">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        
        
          <div class="row">
              
              
            <div class="box box-solid" style="width:100%;">
                    <div class="box-header">

                        <div class="row">
                            
                            <h4> <b>TIENDA OFICIAL | MC.GAMING-FORCE.ES</b> </h4>
                            
                            
                                
                        </div>
                                      
                                      
                                      
            

                    </div>
                    <div class="box-body" style="background:#F7F7F7;">

                        <div class="row" >
                            
                            <div class="col-md-4" style="padding-top:10px;padding-bottom: 10px;">
                                 <span class="right badge badge-warning" style="background: #ffb300;margin-left: 5px;margin-right: 5px;font-size: 1.5em;    ">Tienes : <?php echo $user->minecoins;?> MineCoins</span>
                            </div>
                            <div class="col-md-4" style="padding-top:10px;padding-bottom: 10px;">
                                <button type="button" onclick="AbrirTiendaMineCoins()" class="btn btn-block btn-success"><b>OBTENER MINECOINS</b></button>
                            </div>
                            <div class="col-md-4" style="padding-top:10px;padding-bottom: 10px;">
                                <button type="button" onclick="VaciarCarrito()" class="btn btn-block btn-danger" style=" float:right;max-width:250px;"><b>VACIAR CARRITO</b></button>
                            </div>
                        </div>
                        </br></br>
                
                        
                        
                        <div class="row">
                            
                            <div class="col-md-8">
                                <div class="row">
                            <?php if(strlen($datos['productos']) > 0):?>
                            <?php foreach($datos['productos'] as $p):?>
                            
                                                    <div class="col-md-3" style="padding-top:10px;padding-bottom: 10px;">
                                                        <div class="box-solid" style="min-height: 500px;">
                                <div class="box-header">
                                    <h3><b><?php echo $p->nombre;?></b></h3>


                                </div>
                                                            <div class="box-body" style="padding:30px;" >
                                    <div class="row">
                                      <img src="<?php echo env('APP_URL');?>/assets/imagenes/oro.png" width="100%">  
                                    </div>
                                    <div class="row">
                                        <h6> Descripción del Producto : </h6>
                                        <p><?php echo $p->descripcion;?></p>
                                    </div>
                                  
                                </div>
                                <!-- /.card-body -->
                                <div class="box-footer" style="text-align: center; padding: 30px;">
                                    <div class="row" style="text-align:center;">
                                    <h4 style="text-align: center;"><?php echo $p->precio;?>  <b>MineCoins</b></h4>
                                    </div>
                                    <div class="row">
                                        <button type="button" onclick="AnyadirCarrito('<?php echo $p->id;?>')" class="btn btn-block btn-success">Añadir al Carrito</button>
                                    </div>
                                </div>
                                <!-- /.card-footer-->
                              </div>
                                                    </div>     
                            <?php                           endforeach;?>
                            <?php endif;?>

                        </div>
                                </div>
                            
                            
                            <div class="col-md-4" style="padding-top:10px;padding-bottom: 10px;">
                                
<div class="box box-solid">
        <div class="box-header">
            <h3><b>CARRITO</b></h3>



        </div>
        <div class="box-body" style="padding:30px;">
            <?php $total = 0;?>
            <?php if($datos['productos_carrito'] == null || sizeof($datos['productos_carrito']) == 0):?>
                <p> TIENES <b>0</b> PRODUCTOS EN EL CARRITO </p>
            <?php else:?>

                
                <?php foreach($datos['productos_carrito'] as $pc):?>
                
                <p> 1 - <?php echo $pc['producto']['nombre']." : ".$pc['producto']['precio']." MineCoins";?> </p>
                <?php $total += $pc['producto']['precio'];?>
                <?php endforeach;?>
            <?php endif;?>
            
        </div>
        <!-- /.card-body -->
        <div class="box-footer" style="padding:30px">
            
            <div class="row" style="text-align: center;" >
           
            <p style="float:right">TOTAL : <b><?php echo $total;?> MineCoins</b></p> 
            </div>
            <div class="row" style="text-align: center;">
                <button type="button" onclick="Comprar()" class="btn btn-block btn-primary" style=" float:right;max-width:250px;"><b>COMPRAR</b></button>
            </div>
        </div>
        <!-- /.card-footer-->
        <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
      </div>                                
                                
                                
                            </div>
                            

                            
                            </div>
                        </br></br>
                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer-->
                  </div>              
              
              

          </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  

  
  
@include('comun.footer_landing ')  

</div>

    <script>

        
    </script>

@stop

@section('footer')
    @include('comun.scripts_landing')
    
<?php 
$id_carrito = null;
if($datos['carrito'] != null) $id_carrito = $datos['carrito']['id'];
?>    
    <script>

        var notificaciones_count = document.getElementById("notificaciones_count");
        var fondo_notificacion = document.getElementById("fondo_notificacion");   
        
        $(document).ready(function() {

            ObtenerNotificacionesCount();
        }); 

        function Comprar()
        {
            var _token = document.getElementById("_token").value;
            
                $.ajax({
                        url: '<?php echo env('APP_URL');?>/api/carrito/comprar',
                        data: {"_token":_token},
                        type: 'get',
                        success: function( response){
                            
                            response = JSON.parse(response);
                            
                            if(response.mensaje == "Tienes 0 Productos seleccionados")
                            {
                                swal(response.mensaje,"",'error');
                            }
                            else if(response.mensaje == "No tienes suficientes MineCoins")
                            {
                                swal(response.mensaje,"",'info');
                            }  
                           else
                            {
                                swal(response.mensaje,"",'success'
                                        ).then((result) => {
                                            window.location='<?php echo env('APP_URL');?>/tienda';
                                });
                                
                            }                              

                        },
                        error: function( response ){

                        }
                    });   
                            
            
        }
        
        function VaciarCarrito()
        {
            var id_carrito = '<?php echo $id_carrito;?>';
            var _token = document.getElementById("_token").value;
            
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            
            if(id_carrito != null || id_carrito != 'null')
            {
                $.ajax({
                        url: '<?php echo env('APP_URL');?>/api/carrito/' + id_carrito,
                        data: {"_token":_token},
                        type: 'delete',
                        success: function( response){
                            window.location='<?php echo env('APP_URL');?>/tienda';
                        },
                        error: function( response ){
                            window.location='<?php echo env('APP_URL');?>/tienda';
                        }
                    });   
                }
        }
        
        function AnyadirCarrito(id)
        {

            var _token = document.getElementById("_token").value;
            
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            

                $.ajax({
                        url: '<?php echo env('APP_URL');?>/api/carrito/' + id,
                        data: {"_token":_token},
                        type: 'post',
                        success: function( response){
                            window.location='<?php echo env('APP_URL');?>/tienda';
                        },
                        error: function( response ){
                            window.location='<?php echo env('APP_URL');?>/tienda';
                        }
                    });   
                
        }      
        
        
        function AbrirTiendaMineCoins()
        {
            Swal.fire({
              title: '<strong>Consigue MineCoins</strong>',
              type: '',
              html:
                "<div class=\"row\">" +
                "<div class=\"col-md-4\" >" +
                "<div class=\"row\" >" +
                    "<img src=\"<?php echo env('APP_URL');?>/assets/imagenes/oro.png\" width=\"200px\">" +
                    "<h4 >500 MineCoins</h4>" + 
                "</div>" +
                "<div class=\"row\">" +
                    "<h3><b>5 €</b></h3>" +
                "</div>" +                
                "<div class=\"row\">" +
                "<a href=\"https://mc.gaming-force.es/TornadoTPV/pagar?p=0\"> <button type=\"button\"  class=\"btn btn-block btn-primary\" style=\"margin-left:19%;margin-right:19%;width:60%;\">Comprar 500 MineCoins</button></a>"+
                "</div>" +
                "</div>" +
                "<div class=\"col-md-4\">" +
                "<div class=\"row\">" +
                    "<img src=\"<?php echo env('APP_URL');?>/assets/imagenes/oro.png\" width=\"200px\">" +
                    "<h4>1000 MineCoins</h4>" + 
                "</div>" +
                "<div class=\"row\">" +
                    "<h3><b>7 €</b></h3>" +
                "</div>" +       
                "<div class=\"row\">" +
                "<a href=\"https://mc.gaming-force.es/TornadoTPV/pagar?p=1\"> <button type=\"button\"  class=\"btn btn-block btn-primary\" style=\"margin-left:19%;margin-right:19%;width:60%;;\">Comprar 1000 MineCoins</button></a>"+
                "</div>" +                
                "</div>" +
                "<div class=\"col-md-4\">" +
                "<div class=\"row\">" +
                    "<img src=\"<?php echo env('APP_URL');?>/assets/imagenes/oro.png\" width=\"200px\">" +
                    "<h4>1500 MineCoins</h4>" + 
                "</div>" +
                "<div class=\"row\">" +
                    "<h3><b>10 €</b></h3>" +
                "</div>" +
                "<div class=\"row\">" +
                "<a href=\"https://mc.gaming-force.es/TornadoTPV/pagar?p=2\"> <button type=\"button\"  class=\"btn btn-block btn-primary\" style=\"margin-left:19%;margin-right:19%;width:60%;;\">Comprar 1500 MineCoins</button></a>"+
                "</div>" +                
                "</div>" +             
                
                "</div>" +
                "</div>" + 
                "</br>"+
                "<div class=\"row\">" +
                "<img src=\"<?php echo env('APP_URL');?>/assets/imagenes/paypal.png\" width=\"100px\">" +
                "</div>" + 
                "<div class=\"row\">" +
                "<p>Los pagos se realizan mediante Paypal"+
                "</div>" + 
                "</div>" ,                
              showCloseButton: true,
              showCancelButton: false,
              focusConfirm: false,
              showConfirmButton: false,
              cancelButtonText:
                '<i class="fa fa-thumbs-down"></i>',
              cancelButtonAriaLabel: 'Thumbs down'
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
