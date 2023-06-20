<div class ="content">
<h1>Manage User</h1>

<?php 
$page_current = (isset($_GET['page']) ? '&page='.$_GET['page'] :'');
$table ='';
if (isset($this->data)){
   
    $i = 0;
        foreach ($this->data as $keys => $values){
            $diff = ($i % 2 == 0 ? 'even' : 'odd');
            $status = ($values['status'] == 0 ?'Action' :'Inaction');
            $date   = $values['birthday'] ==''? '': date('d-m-Y',strtotime($values['birthday']));
            $full_name_email = (($values['full_name'] !='' && $values['email']) ? $values['full_name'].' | '.$values['email'] :' ');
            $table .='<div class ="cell '.$diff.'">
                        <p class ="no"><input type ="checkbox" name ="checkbox[]" value ="'.$values['id'].'" id ="check_all"></p>
                        <p class ="name">'.$values['user_name'].'<br> <span> '.$full_name_email.' </span></p>
                        <p class ="id">'.$values['id'].'</p>
                        <p class ="size">'.$date.' </p>
                        <p class ="size">'.$status.'</p>
                        <p class ="size">'.$values['ordering'].'</p>
                        <p class ="size">'.$values['name'].'</p>
                        <p class ="action"><b><a href ="index.php?controller=user&action=edit&id='.$values['id'].$page_current.'">Edit</a>|
                                              <a href ="index.php?controller=user&action=detail&id='.$values['id'].$page_current.'">Detail</a></b></p>
                        </div>    '  ;
    $i++;
    }
}

?>
		<div class = "table">
		<div class ="notice_once" id = "notice_once">
    	<?php echo (isset($this->post) ? $this->post : '');?></div>
			<form action="#" method ="post" id ="form">
				<div class ="cell header">
					<p class ="no"><input type ="checkbox" name ="check_all" value ="check_all" id ="check_all"></p>
					<p class ="name"><b>User Name</b></p>
					<p class ="id"><b>ID</b></p>
					<p class ="size"><b>Birthday</b></p>
					<p class ="size"><b>Status</b></p>
					<p class ="size"><b>Ordering</b></p>
					<p class ="size"><b>Group Name</b></p>
					<p class ="action"><b>Operation</b></p>
				</div>
				<?php echo $table;?>
				<div class ="pagination">
                	 <ul>
                		<?php echo (isset($this->pagination) ? $this->pagination : '');?>
                		
                	</ul>
                </div>	
				<hr>
				<div class ="operation">
                	<input type ="hidden" class ="hidden" name ="hidden">
                	<a class ="add" href ="index.php?controller=user&action=add<?php echo $page_current;?>">Add User</a>
                	<a class ="delete" href ="#" id ="delete">Delete User</a>
            	</div>
            	
			</form></div>
</div>