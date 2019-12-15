<?php 

require_once 'Controller.php';
require_once 'User.php';

class AuthenticationController extends Controller {
  public function login() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $validators = new Validators();
      $rules = [
        'user_id' => ['length' => ['min' => '11', 'max' => '11'],
                      'numeric'],
        'password' => ['length' => ['min' => '8']]
      ];
      if ($validators->validate($rules)) {
        $user = User::find($_POST['user_id']);
        if(($user !== NULL) && ($user->get_password() == $_POST['password'])) {
          $user->login();
          $user->clear_password();
          $context['flash'] = "You're Logged IN Successfully";
          return Views::render_template('home', $context);
        } else {
          $context['error'] = "Username or password doesnot match";
          unset($_POST['password']);        
          $context['form_values'] = $_POST;
          return Views::render_template('login', $context);
        }
      } else {
        unset($_POST['password']);
        $context['form_errors'] = $validators->error_messages;        
        $context['form_values'] = $_POST;
        return Views::render_template('login', $context);
      }
    }
    return Views::render_template('login');
  }

  public function logout() {
    //session_start();
    $user = $_SESSION['user'];
    $user->logout();
    $context['flash'] = "You're Logged OUT Successfully";
    return Views::render_template('home', $context);
  }

  public function register() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $validators = new Validators();
      $rules = [
        'first_name' => ['length' => ['min' => '5', 'max' => '50'],
                         'not_numeric'],
        'last_name' => ['length' => ['min' => '5', 'max' => '50'],
                        'not_numeric'],
        'address' => ['length' => ['min' => '5', 'max' => '100'],
                      'not_numeric'],
        'user_id' => ['length' => ['min' => '11', 'max' => '11'],
                      'numeric'],
        'email' => ['required', 'email'],
        'password' => ['length' => ['min' => '8'],
                       'match_with' => ['target' => 'password_confirmation']]
      ];
      if($validators->validate($rules)) {
        $data = $validators->validated_data;
        try {
          User::register($data['first_name'], $data['last_name'], $data['address'], 
                         $data['user_id'], $data['email'], $data['password']);
        } catch (Exception $e) {
          $context['error'] = "Username already registered";
          unset($data['password']);        
          $context['form_values'] = $data;
          return Views::render_template('register', $context);
        }
        $context['flash'] = "You're Registered Successfully";
        return Views::render_template('login', $context);
      } else {
        unset($_POST['password']);
        unset($_POST['password_confirmation']);
        $context['form_errors'] = $validators->error_messages;        
        $context['form_values'] = $_POST;
        return Views::render_template('register', $context);
      }
    }
    return Views::render_template('register');
  }
}