<?php
class View{
  public function render($nameView){
      $address_view = "view/$nameView.php"; 
      include 'view/header.php';
      require_once $address_view;
      include 'view/footer.php';
  }
}