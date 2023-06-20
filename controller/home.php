<?php
class Home{
    public function show(){
        require_once 'library/view.php';
        $view = new View();
        if (!isset($_GET['controller'])){
            $address ="home/show_home";
        }else{
            $address = $_GET['controller'].'/'.$_GET['action'].'_'.$_GET['controller'];
        }
        $view->render($address);
    }
}