<?php
class Group_Model extends Model {
    public function __construct(){
        parent::__construct();
        $this->setDatabase('tai_khoan');
        $this->setTable('tai_khoan.group');
    }
   
    public function loadDatabase($element,$position=null,$count=null){
        if ($element == 'show'){
            $query ='SELECT `g`.`id`, `g`.`name`, `g`.`status`, `g`.`ordering`, COUNT(`u`.`group_id`) AS member
                 FROM tai_khoan.group AS g LEFT JOIN tai_khoan.user AS u ON `g`.`id` = `u`.`group_id`
                 GROUP BY `g`.`id`
                 LIMIT '.$position.' ,'.$count.'';
        }elseif ($element == 'pagination'){
            $query ='SELECT COUNT(g.id) AS soluong
            FROM tai_khoan.group as g';
        } 
        elseif ($element == 'add'){
            $query ='SELECT g.name
            FROM tai_khoan.group as g';
        } 
        elseif ($element == 'edit'){
            $query ='SELECT g.name,g.id
            FROM tai_khoan.group as g';
        } 
        $result = $this->selectQuery($query);
        return $result;
    }
    public function insertDatabase_add($data){
        
        $this->insertDatabase($data);
        $row = $this->affectRow();
        return $row;
    }
    public function loadDatabase_edit($id){
        $query ='SELECT * FROM tai_khoan.group AS g WHERE g.id = '.$id.'';
        $result = $this->selectQuery($query);
        return $result;
    }
}