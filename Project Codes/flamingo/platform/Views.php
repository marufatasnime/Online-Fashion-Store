<?php 

require_once 'Blueprint.php';

class Views {
  public function render_template($template, $context=NULL) {
    $blueprint = new Blueprint($template);
    $blueprint->render($context);
    return true;
  }

  public function redirect($url) {
    echo 'Logged In';
    header("Location: /flamingo${url}");
    return true;
  }

  public function render_JSON($object) {
    echo json_encode($object);
    return true;
  }
}
