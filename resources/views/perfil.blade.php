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

    </style>    

@stop

@section('body')



  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: url('<?php echo env('APP_URL');?>/assets/imagenes/background.jpg') center center/cover no-repeat; !important;">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content-header">
      <div class="container-fluid">
      <div class="row">
          
          <div class="col-sm-4">

              
              <div class="box box-solid" style="padding:20px;height: 180px; box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2); border-radius: 25px;">


                  <div class="row">
              <div class="col-md-3">
                  <img src="https://cravatar.eu/helmavatar/<?php echo $user->nick;?>/190.png" style="margin-right: 10px;width: 80px;">
              </div> 
              <div class="col-md-9">
                  <div class="row">
                      <a href="#" class="d-block" style="color:black;font-size: 2em;"> [ <b id="rango"></b> ]  <?php echo $user->nick;?></a>
                  </div> 
                  

                  
                  <div id="usuario_conectado" class="row">
                      
                      
                  </div> 
                  

                  
              </div>                        
                      
                  </div>
                       <div class="row" style="margin-top: 20px;">
                           <div class="col-md-4">
                               <button type="button" onclick="window.location='<?php env('APP_URL');?>/perfil/cambiarcontrasenya'" class="btn btn-block btn-danger">Cambiar Contraseña</button>
                           </div>

                           <div class="col-md-4">
                               <button type="button"  onclick="setServicio(1)" style="visibility: hidden;display: none;margin-top:0px;" id="boton_activar_admin" class="btn btn-block btn-danger">Activar ADMIN</button>
                               <button type="button"  onclick="setServicio(0)" style="visibility: hidden;display: none;margin-top:0px;" id="boton_desactivar_admin" class="btn btn-block btn-danger">Desactivar ADMIN</button>
                           </div>
                        
                  </div>
                  
                  
                  
                    </div>
     



              

              

      </div>
          
          <div class="col-md-8">
              
              <div class="row">
              <div class="col-md-3">
                  <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-fw fa-clock-o"></i></span>

              <div class="info-box-content">
                  
                <span class="info-box-text">Tiempo Jugado</span>
                

                <span id="tiempo_jugado" class="info-box-number"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </div>
              
              <div class="col-md-3">
                  <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-fw fa-money"></i></span>

              <div class="info-box-content">
                <span  class="info-box-text">Balance Económico</span>
                

                <span id="balance_economico" class="info-box-number"> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </div> 
                  
              <div class="col-md-3">
                  <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-fw fa-diamond"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MineCoins</span>
                

                <span id="mine_coins" class="info-box-number"> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </div> 

              <div class="col-md-3">
                  <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-fw fa-user-secret"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Estado de la Cuenta</span>
                

                <span id="bans_result" class="info-box-number">CORRECTO </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </div>  
                  
              <div class="col-md-3">
                  <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-fw fa-ship"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Primera Vez Conectado</span>
                

                <span id="created_at" class="info-box-number"> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </div> 
              <div class="col-md-3">
                  <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-fw fa-server"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Última Ip Utilizada</span>
                

                <span id="last_ip" class="info-box-number"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </div>   
              <div class="col-md-3">
                  <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-fw fa-comments"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Verificado En Discord</span>
                

                <span id="discord" class="info-box-number"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </div>                     
              </div>
              
          </div>
          

  </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <br><br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
          <div class="row">
              <div class="col-sm-4">
                  <div class="box box-solid">
                      <div class="box-header with-border">
                          <h3 class="box-title"><b>MIS SUBSCRIPCIONES ACTIVAS</b></h3>


                    </div>
                      
                      <div class="box-body">
                          <div id="pedidos">
                              
                          </div>
                      </div>
                      
                      
                      <div clss="box-footer">
                          <div class="row">
                              <div class="col-md-4" style="padding-top:10px;padding-bottom: 10px;">
                                  
                              </div>
                              <div class="col-md-4" style="padding-top:10px;padding-bottom: 10px;">
                                  <button type="button" onclick="window.location='<?php echo env('APP_URK');?>/perfil/historico'" class="btn btn-block btn-danger">Ver histórico de pedidos</button>
                              </div>
                              <div class="col-md-4" style="padding-top:10px;padding-bottom: 10px;">
                                  
                              </div>                              
                          </div>
                          
                      </div>
                      
                  </div>
                  
                  <?php $rank = $user->getRank();?>
                  <?php if($rank['grupo'] == "ADMIN" || $rank['grupo'] == "DEV" ):?>
                  <div class="box box-solid">
                      <div class="box-header with-border">
                          <h3 class="box-title"><b>PANEL ADMINISTRATIVO</b></h3>


                    </div>
                      
                      <div class="box-body">
                          <button type="button" onclick="window.location='/admin/panel'" class="btn btn-block btn-danger">IR AL PANEL</button>
                      </div>
                      
                      

                  </div>   
                  <?php endif;?>
                  
              </div>
              <div class="col-sm-8">
                  
              </div>
          </div>
               
               
          
          <?php /* *
          <div class="row">
              <div class="col-md-6">
                  
<div class="card">
              <div class="card-header">
                <h5 class="m-0">Inventarios</h5>
              </div>
              <div class="card-body">

              </div>
            </div>
                  
              </div>
              <div class="col-md-6">
                  
<div class="card">
              <div class="card-header">
                <h5 class="m-0">Estadisticas</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>       
                          </div>
          

      </div>*/?>
    </section>
  </div>

  

  
  
@include('comun.footer_landing')  

</div>


@stop

@section('footer')
    @include('comun.scripts_landing')
    

<script>
    
       // var cinta_permisos = document.getElementById("cinta_rango");
        var rango = document.getElementById("rango");
        var usuario_conectado = document.getElementById("usuario_conectado");
        var tiempo_jugado = document.getElementById("tiempo_jugado");
        var balance_economico = document.getElementById("balance_economico");
        var minecoins = document.getElementById("mine_coins");
        var bans_result = document.getElementById("bans_result");
         var created_at= document.getElementById("created_at");
         var last_ip = document.getElementById("last_ip");
         var pedidos = document.getElementById("pedidos");
        var user_id = '<?php echo $user->id;?>';
        var pedidos_texto = "";
        var notificaciones_count = document.getElementById("notificaciones_count");
        var fondo_notificacion = document.getElementById("fondo_notificacion");   
        var boton_activar_admin = document.getElementById("boton_activar_admin");   
        var boton_desactivar_admin = document.getElementById("boton_desactivar_admin"); 
        var discord = document.getElementById("discord"); 
        

        
        $(document).ready(function() {

            ObtenerUsuario();
            ObtenerPedidos();
            ObtenerNotificacionesCount();
            CheckIfIsAdmin();

        }); 
        
        
        function setServicio(valor)
        {
                                    $.ajax({
                                url: '<?php echo env('APP_URL');?>/api/setenservicio/'+valor,
                                type: 'get',
                                dataType : 'JSON',
                                success: function( response){

                                    window.location.reload();
                                    
                                },

                                error: function( response ){
                                    console.log("error");
                                }
                            });
        }
        
        
        function CheckIfIsAdmin()
        {   
            
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/esAdmin',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        

                    if (response == true)
                    {
                        $.ajax({
                                url: '<?php echo env('APP_URL');?>/api/enservicio',
                                type: 'get',
                                dataType : 'JSON',
                                success: function( response){


                                if (response == true)
                                {
                                    boton_desactivar_admin.style.visibility = 'visible';
                                    boton_desactivar_admin.style.display = 'block';



                                }
                                else
                                {
                                    boton_activar_admin.style.visibility = 'visible';
                                    boton_activar_admin.style.display = 'block';



                                }                                
                                },

                                error: function( response ){
                                    console.log("error");
                                }
                            });

                        

                    }
                    },
                            
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(CheckIfIsAdmin, 60000);    
        }           
        
        function ProcesarBans(item,index)
        {
           
            if(item.reason == 'Insult')
            {
                bans_result.innerHTML = bans_result.innerHTML + '<span class=" badge bg-orange" style="margin:2px;">INSULT</span>';
            }               
            if(item.reason == 'Permanently')
            {
                bans_result.innerHTML = bans_result.innerHTML + '<span class=" badge bg-red" style="margin:2px;">BANEADO</span>';
            }
            
        
            
        }
        
        function DibujarPedidos(item, index){
                    var pedido = "<tr><td>"+item.nombre+"</td><td>"+item.fecha_inicio+"</td><td>"+item.fecha_final+"</td></tr>";
            pedidos_texto = pedidos_texto + pedido;
        }
        
        function ObtenerPedidos()
        {   
            

            pedidos_texto = "<table class=\"table table-striped\"> <tbody><th>Producto</th><th>Fecha Inicio</th><th>Fecha Final</th> ";
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/pedidos',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                        if(response.length > 0)
                        {
                            response.forEach(DibujarPedidos);
                            pedidos_texto += "</tbody></table>";
                            pedidos.innerHTML = pedidos_texto;
                        }
                        else
                        {
                            pedidos.innerHTML = " NO HAY SUBSCRIPCIONES EN ACTIVO";
                        }
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerPedidos, 60000);    
        }        
        
        function ObtenerUsuario()
        {   
            

            rango.innerText = "";
            usuario_conectado.innerHTML = "";
            tiempo_jugado.innerHTML = "";
            balance_economico.innerHTML = "";
            minecoins.innerHTML = "";
            created_at.innerText = "";
            last_ip.innerText = "";
            discord.innerText = "";
            bans_result.innerHTML = '<span class=" badge bg-green" style="margin:2px;">CORRECTO</span>';
            
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/user/' + user_id,
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){

                    console.log(response);
                   rango.style.color = response.rank.color;
                    rango.innerText = response.rank.grupo;
                    
                    if(response.online)
                    {
                        if(response.online.online == 1)
                        {
                            usuario_conectado.innerHTML = usuario_conectado.innerHTML + '<span class="float-right badge bg-green" >Conectado</span>';
                        }
                        else
                        {
                            usuario_conectado.innerHTML = usuario_conectado.innerHTML + '<span class="float-right badge bg-red" style="background-color:red;">Desconectado</span>';
                        }
                    }
                    else
                    {
                         usuario_conectado.innerHTML = usuario_conectado.innerHTML + '<span class="float-right badge bg-red" style="background-color:red;">Desconectado</span>';
                    }
                    
                        var horas = parseInt(parseInt(response.playtime)/3600);
                        var minutos = parseInt(parseInt(response.playtime)/60);
                        var segundos = parseInt(response.playtime);
                        if(minutos > 60) minutos = parseInt(minutos % 60);
                        if(segundos > 60) segundos = parseInt(segundos %60);
                      
                        tiempo_jugado.innerText = tiempo_jugado.innerText   + horas + ' h ' + minutos + ' m ' + segundos + ' s';
                        balance_economico.innerText = balance_economico.innerText   + response.balance + " €";
                        minecoins.innerText = minecoins.innerText   + response.minecoins + " MCs";
                        created_at.innerText = created_at.innerText   + response.created_at ;
                        last_ip.innerText = last_ip.innerText   + response.lastIP ;
                        
                        if(response.verified_on_discord == false)
                        {
                            discord.innerHTML = "NO";
                        }
                        else if (response.verified_on_discord == true)
                        {
                           discord.innerHTML = "SI"; 
                        }
                        

                        response.bans.forEach(ProcesarBans);

                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerUsuario, 60000);    
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