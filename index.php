<?php
session_start(); //info sur les session retrouvé sur plusieurs ressources, notamment: https://www.w3schools.com/php/php_sessions.asp

require 'App/Core/Database.php';
require 'Routeur/Routeur.php';

//recupere l'url de la page actuel en omettant le nom du projet
$url = str_replace('/touchepasauklaxon', '', $_SERVER['REQUEST_URI']);
//instancie un nouveau routeur
$routeur = new Routeur();

//ajout des routes
$routeur->addRoute('GET', '/', 'HomeController', 'index');
$routeur->addRoute('GET', '/login', 'AuthController', 'showLogin');
$routeur->addRoute('POST', '/login', 'AuthController', 'login');
$routeur->addRoute('GET', '/logout', 'AuthController', 'logout');
$routeur->addRoute('GET', '/trajet/create', 'TrajetController', 'create');
$routeur->addRoute('POST', '/trajet/store', 'TrajetController', 'store');
$routeur->addRoute('GET', '/trajet/delete', 'TrajetController', 'delete');
$routeur->addRoute('GET', '/trajet/edit', 'TrajetController', 'edit');
$routeur->addRoute('POST','/trajet/update','TrajetController','update');
$routeur->addRoute('GET', '/admin/users', 'AdminController', 'users');
$routeur->addRoute('GET', '/admin/agences', 'AdminController', 'agences');
$routeur->addRoute('GET', '/admin/agence/create', 'AdminController', 'createAgence');
$routeur->addRoute('POST', '/admin/agence/store', 'AdminController', 'storeAgence');
$routeur->addRoute('GET', '/admin/agence/edit', 'AdminController', 'editAgence');
$routeur->addRoute('POST', '/admin/agence/update', 'AdminController', 'updateAgence');
$routeur->addRoute('GET', '/admin/agence/delete', 'AdminController', 'deleteAgence');

//appelle la methode dispatch de la classe routeur et lui donne en argument l'url recuperer plus tot
$routeur->dispatch($url); 