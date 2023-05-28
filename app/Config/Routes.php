<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Bienvenida::index');
$routes->get('login', 'Login::index');
$routes->get('registro', 'Registro::index');
$routes->post('registrar', 'Registro::registrarUsuario');
$routes->post('/login/validar', 'Login::login');
$routes->get('/home/tareas', 'Home::index');
//$routes->post('/home/tareas', 'Home::index');
//$routes->post('/home/tareas', 'Home::index');
$routes->get('/logout', 'Login::logout');

$routes->get('home/tarea/(:num)', 'Tarea::ver_tarea/$1');

///////////////////////////////
$routes->get('home/tareas/nuevatarea', 'Tarea::nueva_tarea');
$routes->post('/home/tareas/validartarea', 'Tarea::validar_tarea');
$routes->get('/home/tareas/editar/(:num)', 'Tarea::editar_tarea/$1');
$routes->post('/home/tareas/editar/actualizar/(:num)', 'Tarea::actualizar_tarea/$1');
$routes->get('/home/tareas/eliminar/(:num)', 'Tarea::eliminar_tarea/$1');
///////////////////////////////
$routes->get('home/subtareas/nuevasubtarea/(:num)', 'Subtarea::nueva_subtarea/$1');
$routes->post('/home/subtareas/nuevasubtarea/validarsubtarea/(:num)', 'Subtarea::validar_subtarea/$1');
$routes->get('/home/tareas/eliminarsubtarea/(:num)', 'Subtarea::eliminar_subtarea/$1');
$routes->get('/home/tareas/editarsubtarea/(:num)', 'Subtarea::editar_subtarea/$1');
$routes->post('/home/tareas/editarsubtarea/actualizar/(:num)', 'Subtarea::actualizar_subtarea/$1');
$routes->post('/home/tareas/editarsubtarea/actualizarestado/(:num)', 'Subtarea::actualizar_subtarea_estado/$1');
//////////////////////////////
$routes->get('home/archivado','Home::archivado');
$routes->get('home/tareas/archivar/(:num)','Home::archivar/$1');
////////////////////////////
$routes->post('home/tareas','Home::ordenar');

//$routes->post('/Internas/home_tareas', 'InicioSesion::exito');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
