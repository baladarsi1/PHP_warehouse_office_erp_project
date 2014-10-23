<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
/*$route['news/create'] = 'news/create';
$route['news/(:any)'] = 'news/view/$1';
$route['news'] = 'news';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';*/
$route['default_controller'] = "login_controller/view/loginhome";
$route['404_override'] = '';
$route['users'] = 'user_controller/view/loginhome';
$route['login'] = 'login_controller/user_check';
$route['projects'] = 'vmk/disdata';
$route['events']='events/disdata';
$route['track']='projectsselect_controller/project_retrive';
$route['logout']='login_controller/delete_sess';
$route['client']='client_controller/client_projects';
$route['new_project']='vmk/view/add_project';
$route['all_projects']='vmk/disdata';
$route['new_event']='events/view';
$route['all_events']='events/disdata';
$route['project']='projectsselect_controller/project_form';
$route['assign_project/(:any)']='projectsselect_controller/link1/$1';
$route['my_track']='projectsselect_controller/my_track/my_track';
$route['home']='user_controller/home';
$route['invoice_create']='accounts/view/addinvoice';
$route['clear_invoice']='accounts/view/payinvoice';
$route['view_invoice']='accounts/view/show_invoice';
$route['view_incomes']='accounts/view_incomes';
$route['bill_create']='accounts/view/addbill';
$route['clear_bill']='accounts/view/paybill';
$route['view_bill']='accounts/view/show_exp';
$route['investment_create']='accounts/view/investment';
$route['investment_view']='accounts/view_investment';
$route['invoice_create']='accounts/view/addinvoice';
$route['myaccount']='accounts/myaccount';
$route['modification/(:any)']='projectsselect_controller/add_modifications/$1';
$route['modifications/(:any)']='projectsselect_controller/view_modifications/$1';


/*$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */