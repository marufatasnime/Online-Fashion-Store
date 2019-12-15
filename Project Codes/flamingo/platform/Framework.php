<?php 

spl_autoload_register(function ($class) {
  /*
  if (file_exists("${class}.php")) {
    require_once "${class}.php";
  } else if (file_exists("controllers/${class}.php")) {
    require_once "controllers/${class}.php";
  }
  */
  
  require_once "${class}.php";
  $controllers = glob('controllers/*.php');

  foreach($controllers as $controller)
    require_once $controller;
});

abstract class Framework {

  /**
   * Created by TANZIM AHMED on 30th November 2019
   * 
   * This is a very basic MVC-style framework created for
   * a easier and cleaner php coding.
   * 
   * This framework uses ONLY PHP in-built functions to 
   * make the developement process that much easier!
   */
  
  abstract function start();

  public function terminate() {
    Routes::url_not_found();
  }
}