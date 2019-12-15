<?php 

require_once 'Controller.php';
require_once 'platform/Validators.php';

class PagesController extends Controller{
  public function index() {
    return Views::render_template('home');
  }

  public function test(){
    $context['cart_items'] = [1,2, 3];
    return Views::render_template('cart', $context);
  }
}
