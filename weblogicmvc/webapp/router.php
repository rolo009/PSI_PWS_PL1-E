<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName@methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');
Router::get('home/login',	'HomeController/login');

Router::get('home/login',	'HomeController/login');

Router::get('home/about','HomeController/about');

Router::get('jogo/index','GameController/index');
Router::get('jogo/game','GameController/game');
Router::get('jogo/instrucoes','GameController/instructions');
Router::get('jogo/registar','GameController/register');
Router::get('jogo/login','GameController/login');
Router::get('jogo/area_privada','GameController/private_area');
Router::get('jogo/editar_registo','GameController/update_register');
Router::get('jogo/top10','GameController/topTen');


/************** End of URLEncoder Routing Rules ************************************/