<?php
class Controller{
    public function __construct(){   
        $this->view = new View();
        
    }
    public function loadDatabase($controller){
        $addressload ='model/'.$controller.'_model.php';
        $name = ucfirst($controller).'_Model';
        require_once $addressload;
        $this->db = new $name();
    }
}