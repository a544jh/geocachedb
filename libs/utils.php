<?php
require_once 'libs/models/user.php';
session_start();


function showView($page, $data = array()){
    $data = (object)$data;
    require 'views/template.php';
    exit();
}

function loggedIn(){
    return isset($_SESSION['user']);
}

function userHasMinRole($role){
    return (loggedIn() && $_SESSION['user']->getRole() >= $role);
}