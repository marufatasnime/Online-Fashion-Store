<?php 

class Blueprint {
  private $template_name;

  public function __construct($template_name){
    $this->template_name = "./templates/${template_name}.template.php";
  }

  private function load_template($context) {
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
      $logged_in = true;
      $user = $_SESSION['user'];
    } else
      $logged_in = false;

    require_once $this->template_name;
    if(isset($extend_layout))
      require_once "./templates/${extend_layout}.template.php";
  }

  public function render($context){
    $this->load_template($context);
  }

  
}

function url_for($static_item) {
  echo "/flamingo/static/${static_item}";
}
