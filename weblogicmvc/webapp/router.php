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
Router::get('jogo/game','GameController/iniciarJogo');
Router::get('jogo/instrucoes','GameController/instructions');
Router::get('jogo/registar','GameController/register');
Router::get('jogo/login','GameController/login');
Router::get('jogo/area_privada','GameController/private_area');
Router::get('jogo/editar_registo','GameController/update_register');
Router::get('jogo/top10','GameController/topTen');
Router::get('jogo/admin','GameController/admin');


Router::get('jogo/rodarDados','GameController/rolarDados');
Router::get('jogo/seleciona','GameController/selecionaNumeroP1');
Router::get('jogo/selecionaP2','GameController/selecionaNumeroP2');

Router::get('jogo/fimP1','GameController/fimJogoP1');
Router::get('jogo/fimP2','GameController/fimJogoP2');
Router::get('jogo/gravar','GameController/gravaDadosBD');

Router::resource('user', 'UserController');

/************** End of URLEncoder Routing Rules ************************************/