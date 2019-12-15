<?php 

require_once 'Extras.php';

$form_errors;
$form_values;

function form_error($name) {
  global $form_errors;
  if (isset($form_errors[$name])) {
    display_errors($form_errors[$name]);
  }
}

function old_value($name) {
  global $form_values;
  if (isset($form_values[$name])) {
    echo $form_values[$name];
  }
}

function url_for($static_item) {
  echo "/flamingo/static/${static_item}";
}

class Blueprint {
  private $template_name;
  private $extend_layout;

  public function __construct($template_name){
    $this->template_name = "./templates/${template_name}.template.php";
  }

  private function load_template() {
    require_once $this->template_name;
    if(isset($extend_layout))
      $this->extend_layout = $extend_layout;
      //require_once "./templates/${extend_layout}.template.php";
  }

  public function render($context){
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
      $logged_in = true;
      $user = $_SESSION['user'];
    } else
      $logged_in = false;

    global $form_errors, $form_values;

    if (isset($context['form_errors']))
      $form_errors = $context['form_errors'];

    if (isset($context['form_values']))
      $form_values = $context['form_values'];  

    $this->load_template();
    if(isset($this->extend_layout))
      require_once "./templates/{$this->extend_layout}.template.php";
  }

}

