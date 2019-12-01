<?php 

require_once 'Controller.php';

class PagesController extends Controller{
  public function index() {
    return Views::render_template('home');
  }
}
