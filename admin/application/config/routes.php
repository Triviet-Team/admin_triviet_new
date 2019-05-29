<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'lapse/error_404';
$route['translate_uri_dashes'] = FALSE;

#contact

$route['lien-he.html'] = 'contact/index';
$route['gioi-thieu.html'] = 'staticpage/index/gioi-thieu';

#Static page
$route['phuong-thuc-van-chuyen.html'] = 'staticpage/index/phuong-thuc-van-chuyen';
$route['chinh-sach-quy-dinh-chung.html'] = 'staticpage/index/chinh-sach-quy-dinh-chung';
$route['chinh-sach-doitra-hang-va-hoan-tien.html'] = 'staticpage/index/chinh-sach-doitra-hang-va-hoan-tien';
$route['chinh-sach-van-chuyen-giao-nhan.html'] = 'staticpage/index/chinh-sach-van-chuyen-giao-nhan';
$route['quy-dinh-va-hinh-thuc-thanh-toan.html'] = 'staticpage/index/quy-dinh-va-hinh-thuc-thanh-toan';
$route['chinh-sach-bao-mat-thong-tin.html'] = 'staticpage/index/chinh-sach-bao-mat-thong-tin';
$route['chinh-sach-bao-hanh.html'] = 'staticpage/index/chinh-sach-bao-hanh';
$route['cham-soc-khach-hang.html'] = 'staticpage/index/cham-soc-khach-hang';
$route['thong-tin-van-chuyen.html'] = 'staticpage/index/thong-tin-van-chuyen';
$route['hang-tra-ve.html'] = 'staticpage/index/hang-tra-ve';
$route['hoi-dap.html'] = 'staticpage/index/hoi-dap';
$route['bao-dam.html'] = 'staticpage/index/bao-dam';
$route['he-thong-phan-phoi.html'] = 'staticpage/index/he-thong-phan-phoi';
$route['gioi-thieu-ve-trilastin.html'] = 'staticpage/index/gioi-thieu-ve-trilastin';
$route['giay-phep.html'] = 'staticpage/index/giay-phep';
$route['tai-sao-phai-chon-trilastin.html'] = 'staticpage/index/tai-sao-phai-chon-trilastin';

#News
$route['thong-tin-san-pham.html'] = 'articles/index/thong-tin-san-pham';
$route['thong-tin-san-pham/page/(:num)'] = 'articles/index/thong-tin-san-pham/$1';
$route['(:any)-a(:num).html'] = 'articles/detail/$1/$2';

#dự án
$route['du-an.html'] = 'project/index/du-an';

$route['du-an/page/(:num)'] = 'project/index/du-an/$1';

$route['du-an/(:any).html'] = 'project/detail/$1';

#dự án
$route['tu-van.html'] = 'project/index/tu-van';

$route['tu-van/page/(:num)'] = 'project/index/tu-van/$1';

$route['tu-van/(:any).html'] = 'project/detail/$1';

#Service
$route['dich-vu.html'] = 'service/index';

$route['dich-vu/page/(:num)'] = 'service/index/tin-tuc/$1';

$route['dich-vu/(:any).html'] = 'service/detail/$1';

#Product
 $route['get-detail.html'] = 'product/get_detail';

 $route['san-pham.html'] = 'product/index';

 $route['san-pham/page/(:num)'] = 'product/index/$1';

 $route['(:any)-p(:num).html'] = 'product/detail/$1/$2';
 
 $route['(:any).html'] = 'product/category/$1';

 $route['(:any)/page/(:num)'] = 'product/category/$1';

 

 $route['tim-kiem.html'] = 'product/search';
 
 


#User
$route['dang-ky.html'] = 'users/signup';

$route['dang-nhap.html'] = 'users/signin';

$route['dang-xuat.html'] = 'users/signout';

/* * ************************ */

#Sitemap
$route['sitemap.xml'] = 'sitemap/index';

#Review url Admin 
#Note: not set

$route['admincp/product_category/(:num)'] = 'admincp/product_category/index/';

$route['admincp/product/(:num)'] = 'admincp/product/index/';

$route['admincp/staticpage/(:num)'] = 'admincp/staticpage/index';

$route['admincp/articles/(:num)'] = 'admincp/articles/index/';

$route['admincp/contact/(:num)'] = 'admincp/contact/index/';

$route['admincp/province/(:num)'] = 'admincp/province/index/';

$route['admincp/emailregister/(:num)'] = 'admincp/emailregister/index/';

$route['admincp/manager/(:num)'] = 'admincp/manager_link_web/index/';
$route['admincp/manager'] = 'admincp/manager_link_web/index/';

$route['admincp/ads/(:num)'] = 'admincp/ads/index/';

$route['admincp/order/(:num)'] = 'admincp/order/index/';



