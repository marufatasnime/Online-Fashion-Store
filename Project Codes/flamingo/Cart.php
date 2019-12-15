<?php

require_once 'Product.php';

class Cart {
  public $sales_id;
  public $product;
  public $item_quantity;
  private $category_id;
  private $product_id;

  public function __construct($sales_id, $product=Null, $item_quantity=Null) {
    $this->sales_id = $sales_id;
    $this->product = $product;
    $this->category_id = Null;
    $this->product_id = Null;
    $this->item_quantity = $item_quantity;
  }

  public function add($category_id, $product_id) {
    $this->category_id = $category_id;
    $this->product_id = $product_id;
    $product = Product::find($this->category_id, $this->product_id);
    if ($product->quantity_left > 0) {
      $this->item_quantity = $this->fetch_item_quantity();
      if ($this->item_quantity !== Null) {
        $this->item_quantity++;
        $this->update_item_quantity();
        $product->quantity_left--;
        $product->update_quantity_left();
        $_SESSION['cart_items']++;
      } else {
        $this->insert();
        $product->quantity_left--;
        $product->update_quantity_left();
        $_SESSION['cart_items']++;
      }
    }
  }

  public function all() {
    $connection = Database::get_connection();
    $sql = "SELECT * FROM orders WHERE salesID = {$this->sales_id}";
    $result = $connection->query($sql);
    $cart_items = [];
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $cart_items[] = new Cart($this->sales_id, Product::find($row['categoryID'], $row['productID']), $row['quantity']);
      }
    } else
      $cart_items = Null;
    $connection->close();
    return $cart_items;
  }

  public function find($category_id, $product_id) {
    $connection = Database::get_connection();
    $sql = "SELECT * FROM orders WHERE salesID = {$this->sales_id} AND productID = {$product_id} AND categoryID = {$category_id}";
    $result = $connection->query($sql);
    $cart_item = Null;
    if($result->num_rows == 1) {
      while($row = $result->fetch_assoc()) {
        $cart_item = new Cart($this->sales_id, Product::find($row['categoryID'], $row['productID']), $row['quantity']);
      }
    }
    $connection->close();
    return $cart_item;
  }

  public function remove() {
    $connection = Database::get_connection();
    $sql = "DELETE FROM orders WHERE salesID = {$this->sales_id} AND productID = {$this->product->id} AND categoryID = {$this->product->category}";
    if($connection->query($sql) !== true)
      throw new Exception($connection->error);
    $connection->close();
    $this->product->quantity_left += $this->item_quantity;
    $this->product->update_quantity_left();
    $_SESSION['cart_items'] -= $this->item_quantity;
  }

  public function remove_all() {
    $cart_items = $this->all();
    if ($cart_items !== Null) {
      $connection = Database::get_connection();
      $sql = "DELETE FROM orders WHERE salesID = {$this->sales_id}";
      $result = $connection->query($sql);
      if($connection->query($sql) !== true)         
        throw new Exception($connection->error);
      $connection->close();
      foreach ($cart_items as $cart_item) {
        $cart_item->product->quantity_left += $cart_item->item_quantity;
        $cart_item->product->update_quantity_left();
        $_SESSION['cart_items'] -= $cart_item->item_quantity;
      }
    }
  }

  private function fetch_item_quantity() {
    $connection = Database::get_connection();
    $sql = "SELECT quantity FROM orders WHERE salesID = {$this->sales_id} AND productID = {$this->product_id} AND categoryID = {$this->category_id}";
    $result = $connection->query($sql);
    $item_quantity = Null;
    if($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $item_quantity = $row['quantity'];
    }
    $connection->close();
    return $item_quantity;
  }

  private function update_item_quantity() {
    $connection = Database::get_connection();
    $sql = "UPDATE orders SET quantity = {$this->item_quantity} WHERE salesID = {$this->sales_id} AND productID = {$this->product_id} AND categoryID = {$this->category_id}";
    $result = $connection->query($sql);
    if($connection->query($sql) !== true)
      throw new Exception($connection->error);
    $connection->close();
  }

  private function insert() {
    $connection = Database::get_connection();
    $sql = "INSERT INTO orders (salesID,categoryID,productID,quantity) VALUES ('{$this->sales_id}', '{$this->category_id}', '{$this->product_id}', 1)";
    if($connection->query($sql) !== true)
      throw new Exception($connection->error);
    $connection->close();
  }
}