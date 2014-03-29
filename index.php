<?php
require_once 'libs/utils.php';

if (isset($_GET['login']) && $_GET['login'] == 'success'){
    showView('index.php', array('success' => "Login successful!"));
}

showView('index.php');