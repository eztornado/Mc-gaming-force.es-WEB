@extends('layouts.layout')

@section('header')
 @include('comun.navbar_landing')
    
    
<style>
    <?php /*
    .sidebar-mini .nav-sidebar, .sidebar-mini .nav-sidebar .nav-link, .sidebar-mini .nav-sidebar > .nav-header {

    font-family: 'Sigmar One', cursive;
    font-size: 1em;
    color:white;
    }
    
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active  {
        background: url('https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fres.freestockphotos.biz%2Fpictures%2F6%2F6235-illustration-of-a-blank-gray-button-beveled-background-pv.png&f=1') center center/cover no-repeat !important;
        border-radius: 0px !important;
    }  
    
    .sidebar-dark-primary .nav-sidebar > .nav-item > a {
        background: url('https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fres.freestockphotos.biz%2Fpictures%2F6%2F6235-illustration-of-a-blank-gray-button-beveled-background-pv.png&f=1') center center/cover no-repeat !important;
        border-radius: 0px !important;
    }
    
    h1{
    font-family: 'Sigmar One', cursive;
    font-size: 1em;
    color:white !important;        
        
    }
    
    p{
    font-family: 'Sigmar One', cursive;
    color:white !important;        
        
    }    
    
    h3{
    font-family: 'Sigmar One', cursive;
    color:white !important;        
        
    }
    
*/?>
    
  
    
    
</style>    

@stop

@section('body')



  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="content" style="background: url('<?php echo env('APP_URL');?>/assets/imagenes/background.jpg') center center/cover no-repeat; !important;">

      <iframe  id="iframe" src="http://mc.gaming-force.es:8800/network#tab-network-overview" width="100%" onload="getDocHeight()"> </iframe>
     
  </div>

  

  
  
@include('comun.footer_landing')  

</div>

    <script>

        
    </script>

@stop

@section('footer')
    @include('comun.scripts_landing')
    
    <script>
        
        var jugadores_online = document.getElementById("jugadores_online");
        var titulo_jugadores = document.getElementById("titulo_jugadores_online");
        var estado_red = document.getElementById("estado_red");
        var total_jugadores = document.getElementById("total_usuarios");
        var total_playtime = document.getElementById("total_playtime");
        var notificaciones_count = document.getElementById("notificaciones_count");
        var content = document.getElementById("content");
        var iframe = document.getElementById("iframe");

        
        $(document).ready(function() {


            ObtenerNotificacionesCount();
            getDocHeight();
        }); 
        
        function getDocHeight() {

            var height = Math.max( content.scrollHeight, content.offsetHeight, 
                content.clientHeight );
            iframe.style.height = height - 5 + "px";    
                
        }        
        
        
 function DibujarUsuariosOnline(item, index)
        {
            var usuario = '<a href="#" style="margin-right: 5px;margin-left:5px;"><img src="https://cravatar.eu/helmavatar/'+item.nombre+'/190.png" style="width: 50px;"></a>';
            jugadores_online.innerHTML = jugadores_online.innerHTML + usuario;
        }
        
        
        
        
        function ObtenerPlayTimeTotal()
        {   
            

            total_playtime.innerText = "";
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/users/playtime_global',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                        
                        var horas = parseInt(parseInt(response)/3600);
                        var minutos = parseInt(parseInt(response)/60);
                        var segundos = parseInt(response);
                        if(minutos > 60) minutos = parseInt(minutos % 60);
                        if(segundos > 60) segundos = parseInt(segundos %60);
                      
                        total_playtime.innerText = total_playtime.innerText   + horas + ' h ' + minutos + ' m ' + segundos + ' s';
                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerPlayTimeTotal, 60000);    
        }
                
        
        function ObtenerTotalJugadores()
        {   
            

            total_jugadores.innerText = "";
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/users?tam=1',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                        
                        total_jugadores.innerText = total_jugadores.innerText   + response;
                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerTotalJugadores, 60000);    
        }
        
        
            
        
        function ObtenerJugadoresOnline()
        {   
            

            jugadores_online.innerHTML = "";
            titulo_jugadores.innerText = "JUGADORES ONLINE ";
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/jugadores_online',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                        
                        titulo_jugadores.innerText = titulo_jugadores.innerText   +' ( '+response.length+' / 1000 )';
                        response.forEach(DibujarUsuariosOnline);
                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerJugadoresOnline, 60000);    
        }
        
        function ObtenerEstadoRed()
        {   
            

            estado_red.innerHTML = "";
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/network_status',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                        if(response.bungeecord == 0)
                        {
                            estado_red.innerHTML += '<span class="right badge badge-danger" style="margin-left: 5px;margin-right: 5px;">BUNGEECORD</span>';                
                        }
                        else
                        {
                            estado_red.innerHTML += '<span class="right badge badge-success" style="margin-left: 5px;margin-right: 5px;background:green;">BUNGEECORD</span>'; 
                        }
                        if(response.auth == 0)
                        {
                            estado_red.innerHTML += '<span class="right badge badge-danger" style="margin-left: 5px;margin-right: 5px;" >AUTH</span>';      
                        }
                        else
                        {
                            estado_red.innerHTML += '<span class="right badge badge-success" style="margin-left: 5px;margin-right: 5px;background:green;">AUTH</span>';      
                        }       
                        if(response.survival == 0)
                        {
                            estado_red.innerHTML += '<span class="right badge badge-danger" style="margin-left: 5px;margin-right: 5px;">SURVIVAL</span>';      
                        }
                        else
                        {
                            estado_red.innerHTML += '<span class="right badge badge-success" style="margin-left: 5px;margin-right: 5px;background:green;">SURVIVAL</span>';      
                        }   
                        if(response.factions == 0)
                        {
                            estado_red.innerHTML += '<span class="right badge badge-danger" style="margin-left: 5px;margin-right: 5px;">FACTIONS</span>';      
                        }
                        else
                        {
                            estado_red.innerHTML += '<span class="right badge badge-danger" style="margin-left: 5px;margin-right: 5px;background:green;">FACTIONS</span>';      
                        }                        
                        
                        

                    },
                    error: function( response ){
                        console.log("error");
                    }
                });
                
            setTimeout(ObtenerEstadoRed, 60000);    
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
