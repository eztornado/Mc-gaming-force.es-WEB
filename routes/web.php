<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//LANDING
Route::get('/', 'LandingController@index');
Route::get('/panel_servidores', 'LandingController@PanelServidores');
Route::get('/bans/{pag}', 'BansController@index');
Route::get('/bans/', 'BansController@index');


//AUTH
Route::get('/login', 'LoginController@index');
Route::get('/logout', 'LoginController@logout');
Route::post('/doLogin', 'LoginController@doLogin');

//PANEL
Route::get('/estado_red', 'PanelController@index');
Route::get('/perfil', 'PerfilController@index');
Route::get('/perfil/cambiarcontrasenya', 'PerfilController@cambiarContrasenya');
Route::get('/perfil/historico', 'PerfilController@historicoProductosPedidos');
Route::get('/tienda', 'TiendaController@index');
Route::get('/notificaciones', 'NotificacionesController@index');

//Admin
Route::get('/admin/panel','admin\AdminPanelController@index');
Route::get('/admin/users','admin\AdminUsersController@index');
Route::get('/admin/perfil/{id}','admin\AdminUsersController@perfil');
Route::get('/admin/pedidos','admin\AdminPedidosController@index');
Route::get('/admin/bans','admin\AdminBansController@index');
Route::get('/admin/economy','admin\AdminEconomiaController@index');
Route::get('/admin/permisos_de_grupo','admin\AdminPermisosController@permisos_de_grupo');
Route::get('/admin/permisos_de_usuario','admin\AdminPermisosController@permisos_de_usuario');
Route::get('/admin/permisos_grupos','admin\AdminPermisosController@permisos_grupos');
Route::get('/admin/permisos_players','admin\AdminPermisosController@permisos_players');
Route::get('/admin/permisos_de_grupo/eliminar/{id}','admin\AdminPermisosController@eliminar_permiso_grupo');
Route::get('/admin/permisos_de_usuario/actualizar/{id}/grupo/{grupo}','admin\AdminPermisosController@actualizar_permiso_usuario');
Route::get('/admin/permisos_de_grupo/add','admin\AdminPermisosController@ver_anyadir_permiso_grupo');
Route::get('/admin/permisos_de_grupo/add/{grupo}/{permiso}/{value}/{server}/{world}','admin\AdminPermisosController@anyadir_permiso_grupo');
Route::get('/admin/permisos_de_usuario/add/{usuario}/{grupo}','admin\AdminPermisosController@anyadir_permiso_usuario');
Route::get('/admin/permisos_players/actualizar/{nombre}/grupo/{grupo}','admin\AdminPermisosController@anyadir_player');



//API
Route::get('api/jugadores_online', 'api\UsersController@getUsuariosOnline');
Route::get('api/notificaciones', 'api\NotificacionesController@index');
Route::get('api/notificaciones/{id}', 'api\NotificacionesController@visto');
Route::get('api/network_status', 'api\EstadoRedController@getNetworkStatus');
Route::get('api/users', 'api\UsersController@index');
Route::get('api/user/{id}', 'api\UsersController@show');
Route::get('api/user/updatepassword/{nueva}', 'api\UsersController@actualizarContrasenya');
Route::get('api/esAdmin', 'api\UsersController@EsAdmin');
Route::get('api/enservicio/', 'api\UsersController@GetEnServicio');
Route::get('api/setenservicio/{valor}', 'api\UsersController@SetEnServicio');
Route::get('api/bans/{pag}', 'api\BansController@index');
Route::get('api/pedidos', 'api\PedidosController@index');

Route::delete('api/carrito/{id}', 'api\CarritoController@delete');
Route::post('api/carrito/{id}', 'api\CarritoController@anañadirProducto');
Route::get('api/carrito/comprar', 'api\CarritoController@comprar');


//PASARELA DE PAGO PAYPAL
Route::get('TornadoTPV/pagar', 'PaymentController@payWithpaypal');
Route::get('TornadoTPV/status', 'PaymentController@getPaymentStatus');
