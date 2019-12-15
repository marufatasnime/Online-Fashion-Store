<?php 

require_once 'Controller.php';

class CartController extends Controller{
  public function index() {
    $cart = $_SESSION['user']->cart;
    $context['cart_items'] = $cart->all();
    return Views::render_template('cart', $context);
  }

  public function add($category_id, $product_id) {
    $cart = $_SESSION['user']->cart;
    $cart->add($category_id, $product_id);
    $context['cart_items'] = $cart->all();
    return Views::render_template('cart', $context);
  }

  public function remove($category_id, $product_id) {
    $cart = $_SESSION['user']->cart;
    $cart_item = $cart->find($category_id, $product_id);
    $cart_item->remove();
    $context['cart_items'] = $cart->all();
    return Views::render_template('cart', $context);
  }

  public function cancel() {
    $cart = $_SESSION['user']->cart->remove_all();
    return Views::render_template('cart');
  }

  public function checkout() {

  }

  public function test(){
    $context['cart_items'] = [1,2, 3];
    return Views::render_template('cart', $context);
  }
}
