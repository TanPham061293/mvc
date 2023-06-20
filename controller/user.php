<?php
class User extends Controller{
    

   public function __construct(){
       parent::__construct();
       Session::init();
       if (Session::get('login')==false){
           Session::destroy();
           header('location:index.php?controller=login&action=show');
           exit();
       }
   }
    public function show()
    {
        $error ="";
        $notice ="";
        $this->loadDatabase($_GET['controller']);
        if (count($_POST) >=1){
           
            if (isset($_POST['checkbox'])){
                $having = "('". implode("','", $_POST['checkbox']) ."')";
                $where = "id IN $having";
                $this->db->deleteQuery($where);
                $row = $this->db->affectRow();
                $notice ="đã xóa $row dòng";
            }else{
                $notice = "Chưa chọn dòng xóa.";
            }
        }
        //
        $total_element = $this->db->loadData('pagination');
        $count_page    = 8;
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
        $result = $this->db->loadData($_GET['action'],$position,$count_page);
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
        $error  ="";
        $notice ="";
        $result ='';
        $result_id ='';
        $id ='';
        $this->loadDatabase($_GET['controller']);
        if ($_GET['action'] =='edit'){
            $result_id = $this->db->detail($_GET['id']);
            $this->view->result =$result_id[0];
            
            $id = $result_id[0]['group_id'];
        }
        if (!empty($_POST)){
            require_once 'library/validate.class.php';
            $validate = new Validate($_POST);
            $condition = array(
                                'first_name'  =>array('type' =>'string', 'min' =>'1','max' =>'20'),
                                'last_name'   =>array('type' =>'string', 'min' =>'1','max' =>'30'),
                                'birthday'    =>array('type' =>'date'),
                                'address'     =>array('type' =>'string', 'min' =>'1','max' =>'100'),
                                'user_name'   =>array('type' =>'string', 'min' =>'1','max' =>'50'),
                                'pass_word'   =>array('type' =>'password'),
                                'email'       =>array('type' =>'email')
                            );
            $validate->setRules($condition);
            $validate->run();
            $result =$validate->getResult();
            $this->view->result =$result;
            $error  =$validate->getError();
            if (empty($error)){
                
                $result_query = $this->db->loadData('add');
                $_POST['pass_word'] =md5($_POST['pass_word']);
                
                $check = true;
                if ($_GET['action'] =='add'){
                    foreach ($result_query as $keys => $values){
                        if ($values['user_name'] == $_POST['user_name']){
                            $check = false;
                            break;
                        }
                    }
                    if ($check == true){
                        
                        $this->db->insertDatabase($_POST);
                        $row = $this->db->affectRow();
                        $notice .= "Thêm thành công  $row dòng";
                    }else{
                        $notice .='Thêm thất bại, username đã tồn tại.';
                    }
                } elseif ($_GET['action'] =='edit'){
                    $id = $result_id[0]['id'];
                    foreach ($result_query as $keys => $values){
                        if ($values['user_name'] == $_POST['user_name'] && $values['id'] != $id){
                            $check = false;
                            break;
                        }
                    }
                    
                    
                    if ($check == true){
                       
                        $where = "id = ".$id."";
                        $this->db->updateDatabase($_POST,$where);
                        $row = $this->db->affectRow();
                         $notice .= "Update thành công  $row dòng";
                    }else{
                         $notice .='Update thất bại, username đã tồn tại.';
                    }
                }   
            }      
        } 
        $group_id =$this->db->loadData('selectId');
        
        $option ='';
       if (isset($_POST['group_id'])){
           $id = $_POST['group_id'];
       }
        foreach ($group_id as $keys => $values){  
            if ($id == $values['id']){
                $option.='<option value ="'.$values['id'].'" selected ="selected">'.$values['name'].'</option>';
            }
            $option.='<option value ="'.$values['id'].'">'.$values['name'].'</option>';
        }
        $this->view->option =$option;
        $this->view->error  =$error;
        $this->view->notice =$notice;
        
        $address = $_GET['controller'].'/'.$_GET['action'].'_'.$_GET['controller'];
        $this->view->render($address);
    }
    
    public function edit()
    { 
        // 
       $this->add();
    }

    public function detail()
    {
       
        $this->loadDatabase($_GET['controller']);
        $result = $this->db->detail($_GET['id']);
        $this->view->data = $result[0];
        $address = $_GET['controller'].'/'.$_GET['action'].'_'.$_GET['controller'];
        $this->view->render($address);
    }
    public function delete(){
        if (isset($_POST['id'])) {
            $this->loadDatabase($_GET['controller']);
            $where = 'id = '.$_POST['id'].'';
            $this->db->deleteQuery($where);  
            echo $notice ='Xóa thành công. Bấm vào <a href ="index.php?controller=user&action=show">đây</a> để quay lại.';
        }
    }
}