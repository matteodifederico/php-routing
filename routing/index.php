<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/routing/core/routing.php';

$routing = new Routing(
    $resources = [],
    $basePath = $_SERVER['DOCUMENT_ROOT'] . '/routing/views/', 
    $protectedFolders = ['config', 'core']);
    
$routing->Route('GET', '/routing/', 'home.php');
$routing->Route('POST', '/routing/', 'home.php');
$routing->Route('GET', '/routing/home2', 'home.php');