<?php 

class Routes {
  //private static $urls = [];
  
  public function url($path, $function) {

    /**
     * This class performs the URL routing. All url requests should be 
     * handled with the url function, by creating a url-pattern and
     * attaching it to a controller function to generate a proper view.
     * 
     * The $_GET['url'] captures the url requested by the user.
     * ** It is very important to note that: 
     * ALL url requestes, except for the STATIC FOLDER
     * are captured this way, making all files and directories except the
     * static folder invisible to the user. 
     * 
     * The $path variable accepts a url-pattern to match with the user
     * requested url and the $function accepts the name of the function
     * to call if the pattern matches with the url request.
     * 
     * The defined url-pattern and the requested url are divided into
     * segments if it contains a forward slash. Each segment in the
     * url-pattern is then mathced with that particular segment of the
     * requested url. 
     * 
     * The url pattern can contain defined variables. And these values
     * of these values would be collected from the url-request and 
     * passed into the controller function as parameters.
     * 
     * Currently, a variable can be defined as int to accept only
     * integers values from the url-request or with no modifiers it 
     * accepts any value as a string. 
     */

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
          if ((strpos($var, 'int:') !== false)) {
            if (is_numeric($url_segments[$i])) {
              $var = trim($var, 'int');
              $var = trim($var, ':');
              $arguments[$var] = $url_segments[$i];
              $var_count++;
            } else {
              $i++;
              break;
            }
          } else {
            $arguments[$var] = $url_segments[$i];
            $var_count++;
          }
        } else if($segment == $url_segments[$i]) {
          //echo 'definded segment: ' . $segment;
          //echo 'url segment: ' . $url_segments[$i];
          $seg_count++;
        }
        $i++;
      }
      if (($seg_count + $var_count) == $i ) {
        //echo (($seg_count + $var_count) == $i);
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