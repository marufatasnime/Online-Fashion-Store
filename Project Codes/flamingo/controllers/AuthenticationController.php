<?php 

require_once 'Controller.php';
require_once 'User.php';

class AuthenticationController extends Controller {
  public function login() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user = User::find($_POST['user_id']);
      if(($user !== NULL) && ($user->get_password() == $_POST['password'])) {
        $user->login();
        $user->clear_password();
        $context['flash'] = "You're Logged IN Successfully";
        return Views::render_template('home', $context);
      } else {
        $context['error'] = "Username or password doesnot match";
        return Views::render_template('login', $context);
      }

      //return Views::redirect('/');
      return Views::render_template('home');
    }
    return Views::render_template('login');
  }

  public function logout() {
    session_start();
    $user = $_SESSION['user'];
    $user->logout();
    $context['flash'] = "You're Logged OUT Successfully";
        return Views::render_template('home', $context);
  }

  public function register() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if($_POST['password'] === $_POST['password_confirmation']) {
        try {
          User::register($_POST['first_name'], $_POST['last_name'], $_POST['address'], 
                         $_POST['user_id'], $_POST['email'], $_POST['password']);
        } catch (Exception $e) {
          $context['error'] = "Username already registered";
          return Views::render_template('register', $context);
        }
        $context['flash'] = "You're Registered Successfully";
        return Views::render_template('login', $context);
      } else {
        $context['error'] = "Username or password doesnot match";
        return Views::render_template('register', $context);
      }

      $context['error'] = "Password fields donot match";
      return Views::render_template('register');
    }
    return Views::render_template('register');
  }
}