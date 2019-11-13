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

/* Admin Routes */
// Admin
$route['1dama3na'] = 'admin/index';
$route['1dama3na/login'] = 'admin/login';
$route['1dama3na/logout'] = 'admin/logout';

// User
$route['1dama3na/users'] = 'admin/users';
$route['1dama3na/users/add'] = 'admin/addUser';
$route['1dama3na/users/edit/:any'] = 'admin/editUser';
$route['1dama3na/users/status/:num/:any'] = 'admin/userStatus';

// Provider
$route['1dama3na/providers'] = 'provider/index';
$route['1dama3na/providers/add'] = 'provider/add';
$route['1dama3na/providers/edit/:any'] = 'provider/edit';
$route['1dama3na/providers/status/:num/:any'] = 'provider/status';

// Ad
$route['1dama3na/ads'] = 'ad/index';
$route['1dama3na/ads/add'] = 'ad/add';
$route['1dama3na/ads/edit/:any'] = 'ad/edit';
$route['1dama3na/ads/status/:num/:any'] = 'ad/status';

// FAQ
$route['1dama3na/faqs'] = 'adFaq/index';
$route['1dama3na/faqs/add'] = 'adFaq/add';
$route['1dama3na/faqs/edit/:any'] = 'adFaq/edit';
$route['1dama3na/faqs/status/:num/:any'] = 'adFaq/status';
/* End Admin Routes */

/* User Routes */
// User Logout
$route['user/logout'] = 'user/logout';

// My Account
$route['user'] = 'user/index';
$route['user/:any'] = 'main/loadUser';

$route['reset-password/:any'] = 'user/resetPassword';
/* End User Routes */
 
/* Main Routes */
// FAQ
$route['faq'] = 'main/faq';

// About Us
$route['about-us'] = 'main/aboutUs';

// Click
$route['click'] = 'main/click';
/* Main Routes */

/* APIs */
// Login
$route['api/login'] = 'user/login';

// Register
$route['api/register'] = 'user/add';

// Update User
$route['api/update-user'] = 'user/edit';

// Update User Photo
$route['api/update-photo'] = 'user/updatePhoto';

// Add User Bank Account
$route['api/add-account'] = 'payment/addAccount';

// Update User Bank Account
$route['api/update-account'] = 'payment/editAccount';

// Request for withdrawal
$route['api/withdraw'] = 'payment/withdraw';

// Load View
$route['view/:any'] = 'main/loadView';

// Forgot Password
$route['api/forgot-password'] = 'user/forgotPassword';

// Process click
$route['api/clicked'] = 'main/processClick';
/* End APIs */

$route['ref/:any'] = 'main/click';

$route['default_controller'] = 'main';
$route['404_override'] = 'main/page404';
$route['translate_uri_dashes'] = FALSE;
