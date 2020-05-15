@extends('layouts.layout')

@section('header')
    @include('comun.navbar_landing')
    

@stop

@section('body')


<?PHP

function ParsearTexto($cadena)
{
    if(strpos($cadena,"[IMG]") !== false)
    {
        $inicio = strpos($cadena,"[IMG]");
        $fin = strpos($cadena,"[/IMG]");
        
        $imagen = substr($cadena, $inicio + 5, ($fin-$inicio) -5);
        $imagen = '<img src="'.$imagen.'" style="width: 100%;"></img></br></br>';
        
        $aux = "";
        for($i = $inicio; $i <= $fin+5;$i++)
        {
            $cadena[$i] = "=";
            $aux.="=";
        }
        
        $cadena = str_replace($aux,$imagen, $cadena);
        return ParsearTexto($cadena);
    }
    else if(strpos($cadena,"[URL]") !== false)
    {
        $inicio = strpos($cadena,"[URL]");
        $fin = strpos($cadena,"[/URL]");
        
        $url = substr($cadena, $inicio + 5, ($fin-$inicio) -5);
        $url = '<a href="'.$url.'"> '.$url.' </a>';
        
        $aux = "";
        for($i = $inicio; $i <= $fin+5;$i++)
        {
            $cadena[$i] = "=";
            $aux.="=";
        }
        
        $cadena = str_replace($aux,$url, $cadena);
        return ParsearTexto($cadena);
    }    
    else if(strpos($cadena,"[B]") !== false)
    {
        $cadena = str_replace("[B]","<b>", $cadena);
        $cadena = str_replace("[/B]","</b>", $cadena);
        return ParsearTexto($cadena);
    }
    else
    {
        
        
        if(strlen($cadena) >= 500)
        {
            $aux = "";
            for($i = 0; $i < 500; $i++)
            {
                $aux.= $cadena[$i];
            }
            $aux.= " </br> ... (click para seguir leyendo)";
            return $aux;
        }
        else
        {
            return $cadena;
        }
    }
    
    
}

?>

  <div class="content-wrapper" style="background: url('<?php echo env('APP_URL');?>/assets/imagenes/background.jpg') center center/cover no-repeat;">
    <div class="container" >
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="box box-solid">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="5" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="https://mc.gaming-force.es/images/mcgf1.png" alt="Imagen del servidor">

                    <div class="carousel-caption">
                      Imagen del servidor
                    </div>
                  </div>
                  <div class="item">
                    <img src="https://mc.gaming-force.es/images/mcgf2.png" alt="Imagen del servidor">

                    <div class="carousel-caption">
                      Imagen del servidor
                    </div>
                  </div>
                  <div class="item">
                    <img src="https://mc.gaming-force.es/images/mcgf3.png" alt="Imagen del servidor">

                    <div class="carousel-caption">
                      Imagen del servidor
                    </div>
                  </div>
                  <div class="item">
                    <img src="https://mc.gaming-force.es/images/mcgf4.png" alt="Imagen del servidor">

                    <div class="carousel-caption">
                      Imagen del servidor
                    </div>
                  </div>   
                  <div class="item">
                    <img src="https://mc.gaming-force.es/images/mcgf5.png" alt="Imagen del servidor">

                    <div class="carousel-caption">
                      Imagen del servidor
                    </div>
                  </div>    
                  <div class="item">
                    <img src="https://mc.gaming-force.es/images/mcgf6.png" alt="Imagen del servidor">

                    <div class="carousel-caption">
                      Imagen del servidor
                    </div>
                  </div>                    
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
              </div>
          </div>
          <div class="row">
                  <div class="box box-solid">
                          <div class="row" style="padding-left: 20px;padding-right: 20px;margin-left:0px !important;margin-right: 0px !important;">
                              
                          <div style="float:left">
                          <h4 id="titulo_jugadores_online" class="box-title" >Jugadores Online </h4>
                          </div>
                          <div style="float:right">    
                              <h3 id="estado_red" class="box-title" >  </h3>
                          </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          
                          <div id="jugadores_online" class="row" style="padding-right: 15px;padding-left: 15px;">
                              
                          </div>

                      </div>
                      <!-- /.box-body -->
            
          </div>
          </div>
          
          <div class="row">
              <div class="col-md-6">
                  <div class="box box-solid">
                      <div class="box-header with-border">
                          <h3 class="box-title"><b>NOVEDADES</b>     </h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">

                          <?php if(!is_null($posts)):?>
                          <?php foreach ($posts as $p) :?>
                          
                          <div class="post clearfix" onclick="window.location='https://foro.gaming-force.es/threads/<?php echo $p->thread_id;?>'">
                            <div class="user-block">
                              <img src="https://cravatar.eu/helmavatar/<?php echo $p->username;?>/190.png" style="margin-right: 10px;width: 40px; margin-top: 10px;">
                                  <span class="username">
                                      <h4> <?php echo $p->title;?> </h4>
                                    <p style="margin-top: -10px;">por : <?php echo $p->username;?></p>
                                  </span>
                            </div>
                            <!-- /.user-block -->
                            
                            
                            <p>
                                <?php echo ParsearTexto($p->posts[0]->message);?>
                            </p>

  
                          </div>
                          
                          <?php endforeach;?>
                          <?php endif;?>
                          
                      </div>
                      <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                  <div class="box box-solid">
                      <div class="box-header with-border">
                          <h3 class="box-title"><b>CONECTARSE AL SERVIDOR</b></h3>
                          
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="row">
                              <div class="col-md-6">
                                  <textarea class="js-copytextarea" style="width:100% " rows="1">mc.Gaming-Force.es</textarea>
                              </div>
                              <div class="col-md-6">
                                  <button class="js-textareacopybtn" onclick="copiarLink()">Copiar IP</button>
                              </div>                              
                          </div>
                          
                          
                      </div>
                      <!-- /.box-body -->
                  </div>
                  
                  <div class="box box-solid">
                      <div class="box-header with-border">
                          <h3 class="box-title"><b>SOCIAL</b></h3>
                          
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">

                          
                      </div>
                      <!-- /.box-body -->
                  </div>                  
                  <!-- /.box -->
              </div>
              
              
              <!-- /.col -->
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
    
    <script>
        
        var jugadores_online = document.getElementById("jugadores_online");
        var titulo_jugadores = document.getElementById("titulo_jugadores_online");
        var estado_red = document.getElementById("estado_red");
        var notificaciones_count = document.getElementById("notificaciones_count");
        var fondo_notificacion = document.getElementById("fondo_notificacion");           

        
        $(document).ready(function() {

            ObtenerJugadoresOnline();
            ObtenerEstadoRed();
            ObtenerNotificacionesCount();
        });        
        function copiarLink()
        {
            var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

            copyTextareaBtn.addEventListener('click', function(event) {
              var copyTextarea = document.querySelector('.js-copytextarea');
              copyTextarea.select();

              try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
              } catch (err) {
                console.log('Oops, unable to copy');
              }
            });
        }
        
        
        function DibujarUsuariosOnline(item, index)
        {
            var usuario = '<a href="#" style="margin-right: 5px;margin-left:5px;"><img src="https://cravatar.eu/helmavatar/'+item.nombre+'/190.png" style="width: 20px;"></a>';
            jugadores_online.innerHTML = jugadores_online.innerHTML + usuario;
        }
        
        function DibujarEstadoRed(item,index)
        {
        }
            
        
        function ObtenerJugadoresOnline()
        {   
            

            jugadores_online.innerHTML = "";
            titulo_jugadores.innerText = "Jugadores Online ";
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/api/jugadores_online',
                    type: 'get',
                    dataType : 'JSON',
                    success: function( response){
                        
                        
                        titulo_jugadores.innerText = titulo_jugadores.innerText   +' ('+response.length+'/1000)';
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
