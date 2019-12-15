<?php

require_once 'Application.php';
session_start();

$application = new Application();
$application->start();  

$application->terminate();

?>