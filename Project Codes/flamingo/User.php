<?php 

require_once 'Cart.php';

class User {

  public $first_name;
  public $last_name;
  public $user_id;
  public $session_id;
  public $cart;
  private $password;

  public function __construct($first_name, $last_name, $user_id, $password) {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->user_id = $user_id;
    $this->password = $password;
  }

  public function all() {
    $connection = Database::get_connection();
    $sql = "SELECT * FROM user_details";
    $result = $connection->query($sql);
    print_r($result);
    $connection->close();
  }

  public function find($user_id) {
    $connection = Database::get_connection();
    $sql = "SELECT password, firstName, lastName FROM user_details WHERE userID = ${user_id}";
    $result = $connection->query($sql);
    $connection->close();
    if($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      return new User($row['firstName'], $row['lastName'], $user_id, $row['password']);
    } else 
    return NULL;
  }

  public function register($first_name, $last_name, $address, $user_id, $email, $password) {
    $connection = Database::get_connection();
    $sql = "INSERT INTO user_details (userID,password,firstName,lastName,address,cellPhoneNumber,emailAddress,status)
            VALUES ('${user_id}', '${password}', '${first_name}', '${last_name}', '${address}', '${user_id}', '${email}', 'active')";
    if($connection->query($sql) !== true)
      throw new Exception($connection->error);
    $connection->close();
  }

  public function login() {
    //session_start();
    date_default_timezone_set("Asia/Dhaka");
    $time = date('YmdHis');
    $this->session_id = $time.$this->user_id;
    $this->cart = new Cart($this->session_id);
    //echo $this->session_id;
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = $this;
    $_SESSION['cart_items'] = 0;
  }

  public function logout() {
    $_SESSION['user']->cart->remove_all();
    session_unset();
    session_destroy();
  }

  public function clear_password() {
    $this->password = NULL;
  }

  public function get_password() {
    return $this->password;
  }
}