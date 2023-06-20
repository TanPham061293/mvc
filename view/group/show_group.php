<div class ="content">
<?php
$table ="";
$page_current = (isset($_GET['page']) ? '&page='.$_GET['page'] :'');
if (isset($this->data)){
    if ($this->data ==''){
        $table .= 'Dữ liệu đang cập nhật.';
    }else{
        $i =0;
        foreach($this->data as $keys => $vals){
            $diff_cell = ($i % 2 == 0 ? 'even' : 'odd');
            $status = ($vals['status'] == 0 ? "Action" : "Inaction");
            $table .='<div class ="cell '.$diff_cell.'" >
    					<p class ="no"><input type ="checkbox" name ="checkbox[]" value ="'.$vals['id'].'"></p>
    					<p class ="name">'.$vals['name'].'</p>
    					<p class ="id">'.$vals['id'].'</p>
    					<p class ="size">'.$vals['member'].'</p>
    					<p class ="size">'.$status.'</p>
    					<p class ="size">'.$vals['ordering'].'</p>
    					<p class ="action"><a href ="index.php?controller=group&action=edit&id='.$vals['id'].$page_current.'">Edit</a></p>
    				</div>';
            $i++;
        }
    }
}

?>

<h1>Manage Group</h1>
    <div class ="table">
    	<div class ="notice_once" id = "notice_once">
    	<?php echo (isset($this->post) ? $this->post : '');?></div>
    			<form action="#" method ="post" id ="form">
    				<div class ="cell header">
    					<p class ="no"><input type ="checkbox" name ="check_all" value ="check_all" id ="check_all"></p>
    					<p class ="name">Group Name</p>
    					<p class ="id">ID</p>
    					<p class ="size">Member</p>
    					<p class ="size">Status</p>
    					<p class ="size">Ordering</p>
    					<p class ="action">Operation</p>
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
                		<a class ="add" href ="index.php?controller=group&action=add<?php echo $page_current;?>">Add Group</a>
                		<a class ="delete" id ="delete" href ="#">Delete Group</a>
                		</div>	
                		
    			</form>
    	</div>
</div>