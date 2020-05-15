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
          <div class="row">

            <div class="login-box">
              <div class="login-logo">
                  <a href="../../index2.html" style="color: white;"><b>mc.Gaming-Force.es</b></a>
              </div>
              <!-- /.login-logo -->
              <div class="login-box-body">
                <p class="login-box-msg">Conectate para realizar acciones en tu cuenta</p>

 
                  <div class="form-group has-feedback">
                    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nombre de Usuario">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <div class="col-xs-8">
                        <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button  onclick="doLogin();" class="btn btn-primary btn-block btn-flat">Conectarse</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

              </div>
              <!-- /.login-box-body -->
            </div>              
          </div>
          <div class="row">
              <div class="col-md-4">
                  
              </div>
              <div class="col-md-4">
                  
            
              <div class="callout callout-info">
                <h4><i class="fa fa-fw fa-info"></i> ¡Es necesario entrar al servidor primero!</h4>

                <p>Los datos de acceso son los que se generan al registrarte en el servidor.</p>
              </div>
              </div>
              <div class="col-md-4">
                  
              </div>              
          </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>

  

  
  
@include('comun.footer_landing')  

</div>

    <script>


        function doLogin()
        {   
            
            var nickname = document.getElementById("nickname").value;
            var password = document.getElementById("password").value;
            var _token = document.getElementById("_token").value;
            
            //alert('nickname : ' + nickname + " | password :  " + password ); 
            $.ajax({
                    url: '<?php echo env('APP_URL');?>/doLogin',
                    type: 'post',
                    data: {"_token":_token,"nickname" : nickname, "password" : password},
                    success: function( response){
                        
                        var aux = JSON.parse(response);
                        console.log();
                        if(aux.errors.length == 0)
                        {
                            Swal.fire({
                            title: 'Conectado con éxito',
                             text: "Has iniciado sesión correctamente",
                             type: 'success',
                             showCancelButton: false,
                             confirmButtonText: 'Acceder'
                           }).then((result) => {
                             if (result.value) {
                                 window.location='<?php echo env('APP_URL');?>';
                             }
                           })  
                       }
                       else
                       {
                           swal('Error en el Login',aux.errors[0],'error');
                       }
                                           },
                    error: function( response ){
                        swal('Error en el Login',"No se puede conectar al servidor",'error');
                    }
                });
        }
    </script>

@stop

@section('footer')
    @include('comun.scripts_landing')
    

  
@stop
