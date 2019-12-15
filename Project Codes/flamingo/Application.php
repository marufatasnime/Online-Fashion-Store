<?php 

require_once 'platform/Framework.php';

class Application extends Framework {
  public function start() {
    
    // Define URL-patterns and start handling requests here

    Routes::url('/', 'PagesController::index');
    Routes::url('/test/', 'PagesController::test');
    
    Routes::url('/products/<view>/', 'ProductsController::index');
    Routes::url('/products/<int:category_id>/<int:product_id>/', 'ProductsController::show');
    
    Routes::url('/login/', 'AuthenticationController::login');
    Routes::url('/register/', 'AuthenticationController::register');
    Routes::url('/logout/', 'AuthenticationController::logout');

    Routes::url('/cart/', 'CartController::index');
    Routes::url('/cart/<int:category_id>/<int:product_id>/', 'CartController::add');
    Routes::url('/cart/<int:category_id>/<int:product_id>/remove/', 'CartController::remove');
    Routes::url('/cart/cancel/', 'CartController::cancel');
  }
}
