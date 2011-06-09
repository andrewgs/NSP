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
/* ----------------------------------- authorization/shutdown ---------------------------------------------*/
$route['authorization'] = "users_interface/authorization";
$route['shutdown'] = "users_interface/shutdown";
$route['admin']	= "users_interface/admin_login";
/* ------------------------------------------ views -------------------------------------------------------*/
$route['news/viewimage/:num'] = "users_interface/viewimage";
$route['text/viewimage/:num'] = "users_interface/viewimage";
$route['certificates/viewimage/:num'] = "users_interface/viewimage";
$route['sowner/viewimage/:num'] = "users_interface/viewimage";
$route['owner/viewimage/:num'] = "users_interface/viewimage";
$route['organs/viewimage/:num'] = "users_interface/viewimage";
$route['sorgans/viewimage/:num'] = "users_interface/viewimage";
$route['sproduct/viewimage/:num'] = "users_interface/viewimage";
$route['product/viewimage/:num'] = "users_interface/viewimage";

/* ------------------------------------------ other -------------------------------------------------------*/

/************************************	ADMIN INTRERFACE	***********************************************/