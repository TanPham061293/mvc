<?php
class Bootstrap{
    public function bootstrap(){
        $controllerUrl  = (!isset($_GET['controller']) ?'home' : $_GET['controller']);
        $actionUrl      = (!isset($_GET['action']) ?'show': $_GET['action']);
        $controllerName = ucfirst($controllerUrl);
        
        $addressFile = 'controller/'.$controllerUrl.'.php';
        if (file_exists($addressFile)){
            require_once $addressFile;
            $controller = new $controllerName();
                if (method_exists($controller, $actionUrl)){
                    $controller->$actionUrl();
                }else {
                   $this->error();
                }        
        }else {
            $this->error();
        }     
    }
    public function error(){
      require_once 'controller/ERROR.php';
      $error = new Errors();
      $error->error();
    }
}