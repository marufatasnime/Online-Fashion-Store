<?php

require_once 'Application.php';

$application = new Application();
$application->start();  

$application->terminate();

?>