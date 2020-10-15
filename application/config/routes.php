<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'site';
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = TRUE;
//  $route['^en/(.+)$'] = '$1';
// $route['^br/(.+)$'] = '$1';

// $route['^en$'] = 'language_switcher/switch_lang/en';
//  $route['^br$'] = 'language_switcher/switch_lang/br';

//BLOG
$route['blog/search/(:any)'] = 'blog/index//$1';
$route['blog/c/(:num)'] = 'blog/index/$1';
$route['blog/c/(:num)/search/(:any)'] = 'blog/index/$1/$2';
$route['blog/c/(:num)/search/(:any)/p/(:num)'] = 'blog/index/$1/$2/$3';
$route['blog/c/(:num)/search/(:any)/p'] = 'blog/index/$1/$2';
$route['blog/c/(:num)/p/(:num)'] = 'blog/index/$1//$2';
$route['blog/c/(:num)/search/(:any)/p/(:num)'] = 'blog/index/$1/$2/$3';
$route['blog/c/(:num)/p'] = 'blog/index/$1/';
$route['blog/p/(:num)'] = 'blog/index///$1';
$route['blog/search/(:any)/p/(:num)'] = 'blog/index//$1/$2';
$route['blog/search/(:any)/p'] = 'blog/index//$1';
$route['blog/p'] = 'blog/index/';


$route['blog/(:num)/(:num)/(:any)'] = 'blog/ver/$3/$1/$2';
$route['pt-br/api/(.*)'] = 'api/$1';
$route['en/api/(.*)'] = 'api/$1';
//ADM
$route['painel'] = 'painel/blog';
$route['login'] = 'painel/users/login';
$route['painel/login'] = 'painel/users/login';
$route['painel/sair'] = 'painel/users/sair';
$route['sair'] = 'painel/users/sair';
$route['painel/api/insert_tag'] = 'api/insert_tag';