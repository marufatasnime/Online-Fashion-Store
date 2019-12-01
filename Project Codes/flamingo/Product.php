<?php

class Product {
  public $category;
  public $id;
  public $name;
  public $price;
  private $quantity_left;
  private $cost;

  public function __construct($category, $id, $name, $price, $quantity_left=NULL, $cost=NULL) {
    $this->category = $category;
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->quantity_left = $quantity_left;
    $this->cost = $cost;
  }

  public function all() {
    $connection = Database::get_connection();
    $sql = "SELECT * FROM product_details";
    $result = $connection->query($sql);
    $products = [];
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $products[] = new Product($row['categoryID'], $row['productID'], $row['name'], $row['price']);
      }
    }
    $connection->close();
    return $products;
  }

  public function all_with_categories($view) {
    $result['products'] = self::all_in_range($view);
    $result['categories'] = self::categories_for($view);
    return $result;
  }

  public function find($category_id, $product_id) {
    $connection = Database::get_connection();
    $sql = "SELECT * FROM product_details WHERE productID = ${product_id} AND categoryID = ${category_id}";
    $result = $connection->query($sql);
    $product = NULL;
    if($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $product = new Product($row['categoryID'], $row['productID'], $row['name'], $row['price']);
    }
    $connection->close();
    return $product;
  }

  private function all_in_range($view) {
    $connection = Database::get_connection();
    if ($view == 'women')
      $sql = "SELECT * FROM product_details WHERE categoryID BETWEEN 1000 and 1999";
    else if ($view == 'men')
      $sql = "SELECT * FROM product_details WHERE categoryID BETWEEN 2000 and 2999";
    $result = $connection->query($sql);
    $products = [];
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $products[] = new Product($row['categoryID'], $row['productID'], $row['name'], $row['price']);
      }
    } else 
      $products = NULL;
    $connection->close();
    return $products;
  }

  private function categories_for($view) {
    $connection = Database::get_connection();
    if ($view == 'women')
      $sql = "SELECT * FROM product_category WHERE categoryID BETWEEN 1000 and 1999";
    else if ($view == 'men')
      $sql = "SELECT * FROM product_category WHERE categoryID BETWEEN 2000 and 2999";
    $result = $connection->query($sql);
    $categories = [];
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $categories[] = new Category($row['categoryID'], $row['categoryName']);
      }
    } else
      $categories = NULL;
    $connection->close();
    return $categories;
  }
}

class Category {
  public $id;
  public $name;

  public function __construct($id, $name) {
    $this->id = $id;
    $this->name = $name;
  }
}