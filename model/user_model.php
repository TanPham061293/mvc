<?php
class User_Model extends Model{
    public function __construct(){
       parent::__construct();
       $this->setDatabase('tai_khoan');
       $this->setTable('tai_khoan.user');
    }
    public function loadData($action,$position= null,$count=null){
        if ($action == 'show'){
            $query ='SELECT u.id, u.user_name,u.birthday, u.email, CONCAT(u.last_name," ", u.first_name) AS full_name,g.status, g.ordering, g.name
                 FROM tai_khoan.user AS u LEFT JOIN tai_khoan.group AS g ON g.id = u.group_id LIMIT '.$position.' ,'.$count.'';
        }elseif($action == 'add'){
            $query ='SELECT u.user_name, u.id,u.group_id
                 FROM tai_khoan.user AS u';
        }elseif($action == 'selectId'){
            $query ='SELECT g.id, g.name
                 FROM tai_khoan.group AS g WHERE g.status = 0';
        }elseif ($action == 'pagination'){
            $query ='SELECT COUNT(u.id) AS soluong
            FROM tai_khoan.user as u';
        } 
       $result = $this->selectQuery($query);
       return $result;
    }
    public function detail($id){
        $query ='SELECT u.id, u.user_name,u.birthday, u.email,u.last_name, u.first_name,u.sex, u.address,u.group_id, g.name
                 FROM tai_khoan.user AS u LEFT JOIN tai_khoan.group AS g ON g.id = u.group_id
                  WHERE u.id = '.$id.'';
        $result = $this->selectQuery($query);
        return $result;
    }
}