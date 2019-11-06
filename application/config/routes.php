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
/** ADMIN **/
$route['admin'] = "admin/users/dashboard";
// tags news

//$route['tin-tuc/tuyen-tap-tai-lieu-ielts-simon-writing-moi-nhat-2019-ebook-pdf-37722.html'] = "tin-tuc/ielts-simon-37722.html";

$route['testml'] = "test/speaking/ielts-test-4-14.html";


$route['expert/(:any)-(:num).html'] = "expert/detail/$2/$1";
$route['tag/(:any)-(:num).html'] = "news/tag/$2/$1";
/** NEWS **/
$route['tin-tuc/(:any)-c(:num).html'] = "news/lists/$2/$1";
$route['tin-tuc/(:any)-(:num).html'] = "news/detail/$2/$1";
$route['tu-van.html'] = "news/support";

//////////////COURSE///////////////
$route['khoa-hoc.html'] = "course/index";
$route['khoa-hoc/(:any)/(:any)-(:num).html'] = "course/detail/$3/$2/$1";
$route['bai-hoc/(:any)-(:num).html'] = "course/class_detail/$2/$1";

//Video
$route['video/cate/(:any)-(:num).html'] = "news/lists/$2/$1";
$route['video/detail/(:any)-(:num).html'] = "news/detail/$2/$1";


/** TEST **/ 
$route['test.html'] = "test/index";
$route['test/(:any)-c(:num).html'] = "test/lists/$2/$1";
$route['test/(:any).html'] = "test/skill/$1";
$route['test/(reading|listening|speaking|writing|fulltest)/(:any)-(:num).html'] = "test/detail/$3/$1";
/** API **/

/****Users****/
$route['bai-tap-lop.html'] = "test/class_home";
$route['chia-se-lop-hoc.html'] = "news/byclass";
$route['thong-tin-hoc-vien.html'] = "users/profile";
$route['thong-tin-ca-nhan.html'] = "users/updateprofile";
$route['thay-anh-dai-dien.html'] = "users/changeImage";
$route['doi-mat-khau.html'] = "users/updatepassword";
$route['hoc-vien/bai-hoc/(:any)-(:num).html'] = "users/profile/$2/$1";

$route['writing/fulltest.html'] = "test/lists/3465";
$route['writing/(:any)/write-a-sentence.html'] = "test/lists/3467";
$route['writing/(:any)/respond-a-request.html'] = "test/lists/3468";
$route['writing/(:any)/write-an-opinion-essay.html'] = "test/lists/3469";

///////////CONTACT/////////////////////////
$route['lien-he.html'] = "contact/index";
$route['dang-nhap.html'] = "users/login";


////////// SITEMAP ////////
$route['sitemap.xml'] = "rss/sitemap_index";
$route['sitemap/(:any).xml'] = "rss/sitemap/$1";
/** COMMON **/
//$route['(:any)'] = "frontend/$1";
$route['default_controller'] = "news/index";

// CONTACT
$route['lien-he.html'] = "contact";
$route['nhan-tai-lieu.html'] = "contact/form_tai_lieu";

//Tìm kiếm
$route['tim-kiem.html'] = "news/search";

// Error
$route['404_override'] = '';
$route['404.html'] = 'news/error_404';

$route['translate_uri_dashes'] = FALSE;


/* End of file routes.php */
/* Location: ./application/config/routes.php */