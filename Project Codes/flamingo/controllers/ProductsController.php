<?php 

require_once 'Controller.php';
require_once 'Product.php';

class ProductsController extends Controller {
  public function _index() {
    return Views::render_template('products');
  }

  public function index($view) {
    $context = Product::all_with_categories(strtolower($view));
    return Views::render_template('products', $context);
  }

  public function show($category_id, $product_id) {
    $context['product'] = Product::find($category_id, $product_id);
    //return Views::render_JSON($context);
    return Views::render_template('product', $context);
  }
}