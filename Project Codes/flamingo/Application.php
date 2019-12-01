<?php 

require_once 'platform/Framework.php';

class Application extends Framework {
  public function start() {
    
    // Register URLs and start handling requests here

    Routes::url('/', 'PagesController::index');
    
    Routes::url('/products/<view>/', 'ProductsController::index');
    Routes::url('/products/<category_id>/<product_id>/', 'ProductsController::show');
    
    Routes::url('/login/', 'AuthenticationController::login');
    Routes::url('/register/', 'AuthenticationController::register');
    Routes::url('/logout/', 'AuthenticationController::logout');
  }
}
