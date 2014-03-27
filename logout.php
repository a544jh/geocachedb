<?php
require_once 'libs/utils.php';
unset($_SESSION['user']);

header('Location: login.php');