<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/***********************************	USERS INTRERFACE	***********************************************/

/* ----------------------------------------	users menu	--------------------------------------------------*/
$route[''] = "users_interface/index";
$route['about-me'] = "users_interface/about_me";
$route['about-company'] = "users_interface/about_company";
$route['certificates-company'] = "users_interface/certificates";
$route['products'] = "users_interface/organs";
$route['organ/:num'] = "users_interface/organ_type";
$route['organ/:num/product/:num'] = "users_interface/product";
$route['news/:num'] = "users_interface/news";
$route['news'] = "users_interface/allnews";
$route['mail-sucessfull'] = "users_interface/mail_sucessfull";
/* ----------------------------------- authorization/shutdown ---------------------------------------------*/
$route['admin']	= "users_interface/admin_login";
/* ------------------------------------------ views -------------------------------------------------------*/
$route['news/viewimage/:num'] = "users_interface/viewimage";
$route['text/viewimage/:num'] = "users_interface/viewimage";
$route['certificates/viewimage/:num'] = "users_interface/viewimage";
$route['owner/viewimage/:num'] = "users_interface/viewimage";
$route['organs/viewimage/:num'] = "users_interface/viewimage";
$route['sorgans/viewimage/:num'] = "users_interface/viewimage";
$route['sproduct/viewimage/:num'] = "users_interface/viewimage";
$route['product/viewimage/:num'] = "users_interface/viewimage";

/* ------------------------------------------ other -------------------------------------------------------*/

/************************************	ADMIN INTRERFACE	***********************************************/
$route['profile'] = "admin_interface/profile";
$route['shutdown'] = "admin_interface/shutdown";
$route['admin/text-edit/:num'] = "admin_interface/text_edit";
$route['admin/text-edit/:num/about-me'] = "admin_interface/text_edit";
$route['admin/text-edit/:num/about-company'] = "admin_interface/text_edit";
$route['admin/text-edit/:num/products'] = "admin_interface/text_edit";
$route['admin/text-edit/:num/contact'] = "admin_interface/text_edit";
$route['admin/text-edit/:num/certificates-company'] = "admin_interface/text_edit";
$route['admin/text-edit/:num/products'] = "admin_interface/text_edit";

$route['admin/certificates-edit/:num'] = "admin_interface/certificates_edit";
$route['admin/certificates-delete/:num'] = "admin_interface/certificates_delete";
$route['admin/certificates-add'] = "admin_interface/certificates_add";

$route['admin/organs-add'] = "admin_interface/organs_add";
$route['admin/organs-edit/:num'] = "admin_interface/organs_edit";
$route['admin/organs-delete/:num'] = "admin_interface/organs_delete";

$route['admin/organ/:num/product-add'] = "admin_interface/product_add";
$route['admin/organ/:num/product-edit/:num'] = "admin_interface/product_edit";
$route['admin/organ/:num/product-delete/:num'] = "admin_interface/product_delete";

$route['admin/news-add'] = "admin_interface/news_add";
$route['admin/news-edit/:num'] = "admin_interface/news_edit";
$route['admin/news-delete/:num'] = "admin_interface/news_delete";