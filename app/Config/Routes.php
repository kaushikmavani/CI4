<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('language', 'DashboardController::language');
$routes->post('language/change', 'DashboardController::setLanguage');

// For login and logout
$routes->get('login', 'Auth::index');
$routes->get('logout', 'DashboardController::logout');
$routes->post('attemptlogin', 'Auth::attemptlogin');

// For registration and email verification
$routes->get('register', 'Auth::register');
$routes->post('attemptregister', 'Auth::attemptregister');
$routes->get('emailVerification/(:any)', 'Auth::emailVerification/$1');
$routes->get('emailVerified', 'Auth::emailVerified');

// For forgot password
$routes->get('forgotPassword', 'Auth::forgotPassword');
$routes->post('resetPassword', 'Auth::resetPassword');
$routes->get('forgotResetPassword/(:any)', 'Auth::forgotResetPassword/$1');
$routes->post('updateForgotResetPassword', 'Auth::updateForgotResetPassword');

// For change password
$routes->get('changePassword', 'DashboardController::changePassword');
$routes->post('updatePassword', 'DashboardController::updatePassword');

// For dashboard
$routes->get('dashboard', 'DashboardController::index');

// For profile and update profile
$routes->get('profile', 'DashboardController::profile');
$routes->get('editProfile', 'DashboardController::editProfile');
$routes->post('updateProfile', 'DashboardController::updateProfile');

// For User module
$routes->get('user', 'UserController::index');
$routes->get('user/create', 'UserController::create');
$routes->post('user/store', 'UserController::store');
$routes->get('user/edit/(:num)', 'UserController::edit/$1');
$routes->post('user/update/(:num)', 'UserController::update/$1');
$routes->post('user/delete/(:num)', 'UserController::delete/$1');
$routes->get('user/permission/(:num)', 'UserController::permission/$1');
$routes->post('user/update_permission/(:num)', 'UserController::update_permission/$1');
$routes->post('user/search', 'UserController::search');
$routes->post('user/sorting', 'UserController::sorting');

// For Role module
$routes->get('role', 'RoleController::index');
$routes->get('role/create', 'RoleController::create');
$routes->post('role/store', 'RoleController::store');
$routes->get('role/edit/(:num)', 'RoleController::edit/$1');
$routes->post('role/update/(:num)', 'RoleController::update/$1');
$routes->post('role/delete/(:num)', 'RoleController::delete/$1');

// For Module module
$routes->get('module', 'ModuleController::index');
$routes->get('module/create', 'ModuleController::create');
$routes->post('module/store', 'ModuleController::store');
$routes->get('module/edit/(:num)', 'ModuleController::edit/$1');
$routes->post('module/update/(:num)', 'ModuleController::update/$1');
$routes->post('module/delete/(:num)', 'ModuleController::delete/$1');

// For Gallary module
$routes->get('gallary', 'GallaryController::index');
$routes->get('gallary/upload', 'GallaryController::upload');
$routes->post('gallary/upload_image', 'GallaryController::upload_image');
$routes->post('gallary/delete/(:num)', 'GallaryController::delete/$1');

// For Chat module
$routes->get('chat', 'ChatController::index');

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
