<?php
class Login extends Controller{
    public function __construct(){
        parent::__construct();
        Session::init();
        if (Session::get('login') == true){
            header('location:index.php?controller=group&action=show');
            exit();
        }
        
    }
    public function show(){
        $this->view->post = $_POST;
        $address = $_GET['controller'].'/'.$_GET['action'].'_'.$_GET['controller'];
        
       
        $notice             ="";
        $error_user_name    ="";
        $error_password     ="";
        $flag   = true;
        if (!empty($_POST)){
            if ($_POST['user_name'] ==""){
                $error_user_name ='-Chưa nhập '.'user_name.';
               
                $flag   = false;
            }
            if ($_POST['password'] ==""){
                $error_password = '-Chưa nhập '.'password.';
                $flag   = false;
            }
            if ($flag == true){
                require_once 'library/model.php';
                $data =new Model();
                $query = 'SELECT u.user_name, u.pass_word FROM tai_khoan.user AS U';
                $ruselt =$data->selectQuery($query);
                $check = false;
                foreach ($ruselt as $keys =>$values){
                    if ($_POST['user_name'] == $values['user_name'] && md5($_POST['password']) == $values['pass_word'] ){
                        $check = true;
                        break;
                    }
                }
                if ($check == true){
                    Session::set('login', true);
                    header('location:index.php?controller=group&action=show');
                    exit();
                }else {
                    $notice .= "User hoặc Password không chính xác.";
                }
            }
            $this->view->notice = array('error_user_name'=>$error_user_name,
                                        'error_password'=>$error_password,
                                        'notice'=>$notice
                                             );
        }
        $this->view->render($address);
    }
    
}
