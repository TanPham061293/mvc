<?php
class Pagination{
   
    private $total_page;
    private $show_page;
    private $current_page;
    private $page;
    public  function __construct($total,$show,$current){
        $this->total_page     = $total;
        $this->current_page   = $current;
        $this->show_page      = $show;
    }
    
    public function pagination_show($controller, $action ='show'){   
        
        $this->page .= '<li><label>Page: </label></li><li><a id ="end" href ="?controller='.$controller.'&action='.$action.'&page=1">Start</a></li>';

            if ($this->current_page >= $this->show_page && $this->current_page < $this->total_page){
                for ($i = $this->current_page - 1; $i <= $this->current_page + 1; $i++){
                    $this->addclassCurrent($i,$controller, $action ='show');
                }
            }elseif ($this->current_page < $this->show_page){
                if ($this->total_page <= $this->show_page){
                    for ($i = 1 ; $i <= $this->total_page; $i++){
                        $this->addclassCurrent($i,$controller, $action ='show');
                    }
                }else {
                    for ($i = 1 ; $i <= $this->show_page; $i++){
                        $this->addclassCurrent($i,$controller, $action ='show');
                    }
                }
                
            }else {
                for ($i = $this->total_page - $this->show_page + 1; $i <= $this->total_page ; $i++){
                    $this->addclassCurrent($i,$controller, $action ='show');
                }
            }
            
            if ($this->current_page < $this->total_page -1 && $this->total_page > $this->show_page){
                $this->page .= '<li><a >...</a><a id ="end" href ="?controller='.$controller.'&action='.$action.'&page='.$this->total_page.'">End</a></li><li></li>';
            }else{
                $this->page .= '<li><a id ="end" href ="?controller='.$controller.'&action='.$action.'&page='.$this->total_page.'">End</a></li>';
            }
           
        }
        private function addclassCurrent($i,$controller,$action){
       if ($i == $this->current_page){
           $this->page .= '<li class = "current"><a  href ="?controller='.$controller.'&action='.$action.'&page='.$i.'">'.$i.'</a></li>';
       }else{
           $this->page .= '<li><a  href ="?controller='.$controller.'&action='.$action.'&page='.$i.'">'.$i.'</a></li>';
       }
   }
    public function get_page(){
        return $this->page;
    }
}