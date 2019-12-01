<?php 

class Routes {
  //private static $urls = [];
  
  public function url($path, $function) {
    //self::$urls[] = $path;
    
    $segments = explode('/', trim($path, '/'));
    $url_segments = explode('/', trim($_GET['url'], '/'));
    $arguments = [];

    //echo 'Defined path: ' . trim($path, '/');
    //echo 'Requested path: ' . trim($_GET['url'], '/');
    //echo 'defined count: ' . count($segments);
    //echo 'request count: ' . count($url_segments);

    if (count($segments) == count($url_segments)) {
      $i=0; $seg_count=0; $var_count=0;
      foreach($segments as $segment){
        if (strpos($segment, '<') !== false) {
          $var = trim($segment, '<');
          $var = trim($var, '>');
          $arguments[$var] = $url_segments[$i];
          $var_count++;
        } else if($segment == $url_segments[$i]) {
          //echo 'definded segment: ' . $segment;
          //echo 'url segment: ' . $url_segments[$i];
          $seg_count++;
        }
        $i++;
      }

      if (($seg_count + $var_count) == $i ) {
        if (!call_user_func_array($function, $arguments)) 
          echo 'Error: View Not Generated';
        exit;
      }
    }
  }

  public function url_not_found() {
    echo '404, Page not found';
    http_response_code(404);
  }
}