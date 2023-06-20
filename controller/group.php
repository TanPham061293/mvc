<?php
class Group extends Controller{
    public function __construct(){
        parent::__construct();
        Session::init();
        if (Session::get('login')==false){
            Session::destroy();
            header('location:index.php?controller=login&action=show');
            exit();
        }
    }
   public function show(){
       $this->loadDatabase($_GET['controller']);
      
       $error ="";
       $notice ="";
       if (count($_POST) >=1){
           if (isset($_POST['checkbox'])){
               $having = "('". implode("','", $_POST['checkbox']) ."')";
               $query ="SELECT `g`.`id`, COUNT(`u`.`group_id`) AS member
               FROM tai_khoan.group AS g LEFT JOIN tai_khoan.user AS u ON `g`.`id` = `u`.`group_id`
               GROUP BY `g`.`id` HAVING `g`.`id` IN $having";
               
               $result = $this->db->selectQuery($query);
               $check = true;
               foreach ($result as $keys => $values){
                   if ($values['member'] != 0){
                       $check = false;
                       $notice ="Group xóa còn thành viên trong group.";
                       break;
                   }
               }
               if ($check == true){
                   $where = "id IN $having";
                   $this->db->deleteQuery($where);
                   $row = $this->db->affectRow();
                   $notice ="đã xóa $row dòng";
               }
           }else{
               $notice ="Chưa chọn dòng xóa.";
           }
       }
       //
     
       $total_element = $this->db->loadDatabase('pagination');
       $count_page    = 5;
       $show_page     = 3;
       $position      = 0;
       $total_page    =ceil($total_element[0]['soluong']/$count_page);
       
       if ($total_page > 1){
           if (isset($_GET['page'])){
               $curent_page = $_GET['page'];
               $position = ($curent_page - 1)*$count_page;
           }else{
               $curent_page = 1;
              
           }
           
           require_once 'library/pagination.php';
           $page = new Pagination($total_page,$show_page,$curent_page);
           $page->pagination_show($_GET['controller'],$_GET['action']);
           $this->view->pagination = $page->get_page();
       }
          
       //
       $result = $this->db->loadDatabase($_GET['action'],$position,$count_page);
       if (!empty($result)){
           $this->view->data = $result;
       }else{
           $notice = 'Bảng không có dữ liệu';
           $this->view->notice = $notice;
       }
       $address = $_GET['controller'].'/'.$_GET['action'].'_'.$_GET['controller'];
       $this->view->post =$notice;
       $this->view->render($address);
      
   }
   public function add(){ 
       
       $error ="";
       $notice ="";
       if (!empty($_POST)){
           require_once 'library/validate.class.php';
           $validate = new Validate($_POST);
           $rules =array(
               'name'       =>array('type'=>'string','min'=>'1','max'=>'30'),
               'status'     =>array('type'=>'status'),
               'ordering'   =>array('type'=>'int'   ,'min'=>'1','max'=>'10')
           );
           $validate->setRules($rules);
           $validate->run();
           $error = $validate->getError();
           if (empty($error)){
               
               $this->loadDatabase($_GET['controller']);
               $result = $this->db->loadDatabase($_GET['action']);
               $check = true;
               foreach ($result as $keys => $vals){
                   if ($vals['name'] == $_POST['name']){
                       $check = false;
                       $notice .="- Tên nhóm đã bị trùng.";
                       break;
                   }
               }
               if ($check == true){
                   unset($_POST['submit']);
                   $row = $this->db->insertDatabase_add($_POST);
                   $notice .="- Thêm thành công $row.";
               }  
           }else{
               $notice .="- Thêm thất bại.";       
           }
       }
       $address = $_GET['controller'].'/'.$_GET['action'].'_'.$_GET['controller'];
       $this->view->post   =$_POST;
       $this->view->error  = $error;
       $this->view->notice = $notice;
       $this->view->render($address);
   }
   public function edit(){
       $notice ='';  
       $error  ='';
       $result ='';
       $id = $_GET['id'];
       if (empty($_POST)){
           $this->loadDatabase($_GET['controller']);
           $result = $this->db->loadDatabase_edit($id);
           $notice  ='';
           if (empty($result)){
               $notice .= '- id Không tồn tại.';  
           }else{
               $this->view->post=$result[0];
           }
       }else{
           require_once 'library/validate.class.php';
           $validate = new Validate($_POST);
           $rules =array(
               'name'       =>array('type'=>'string','min'=>'1','max'=>'30'),
               'status'     =>array('type'=>'status'),
               'ordering'   =>array('type'=>'int'   ,'min'=>'1','max'=>'10')
           );
           $validate->setRules($rules);
           $validate->run();
           $error = $validate->getError();
           if (empty($error)){
               
               $this->loadDatabase($_GET['controller']);
               $result1 = $this->db->loadDatabase($_GET['action']);
               $check = true;
               foreach ($result1 as $keys => $vals){
                   if ($vals['name'] == $_POST['name'] && $vals['id'] != $id){
                       $check = false;
                       $notice .="Tên nhóm đã bị trùng.";
                       break;
                   }
               }
               if ($check == true){
                   unset($_POST['submit']); 
                   $where =array('id'=> $_GET['id']);
                   $this->db->updateDatabase($_POST,$where);
                   $notice .="Update thành công.";
               }
           }else{
               $notice .="Update thất bại.";
           }
           $this->view->post=$_POST;
       }
       $this->view->error = $error;
       $this->view->notice = $notice;
       $address = $_GET['controller'].'/'.$_GET['action'].'_'.$_GET['controller'];
       $this->view->render($address);
   }
  
}