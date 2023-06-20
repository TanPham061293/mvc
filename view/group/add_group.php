<div class ="content">
<h1>Add Group</h1>
<?php 
$select1 ='';
$select  ="";
$select2 ='';
if (isset($this->post['status'])){
    if ($this->post['status'] == 0){
        $select1 ="selected ='selected'";
    }elseif ($this->post['status'] == 1){
        $select2 ="selected ='selected'";
    }else{
        $select ="selected ='selected'";
    }
}
$page_current = (isset($_GET['page']) ? '&page='.$_GET['page'] :'');
?>
		<div class ="table">
			<form action="#" method ="post" id ="form">
			<div class ="notice">
			<?php echo (isset($this->notice) ? $this->notice :'');?>
			</div>
				<div class ="row">			
					<p class ="name" ><b>Group Name</b></p>
					<p><input type ="text" name = "name" placeholder ="Nhập tên nhóm." value ="<?php echo (isset($this->post['name'])? $this->post['name']:'');?>">		
					<div class ="error"><?php echo (isset($this->error['name'])?$this->error['name'] :'')?></div>
					<p class ="size"><b>Status</b></p>
					<p><select name = "status" class ="status" >
					<option value = '3'  <?php echo $select;?>>Select Status</option>
					<option value = '0'  <?php echo $select1;?>>Action</option>
					<option value = '1'  <?php echo $select2;?>>Inaction</option>
					</select></p>
					<div class ="error"><?php echo (isset($this->error['status']) ? $this->error['status']:'') ?></div>
					<p class ="size" ><b>Ordering</b></p>
					<p><input type ="text" name ="ordering" placeholder ="1->10." value ="<?php echo (isset($this->post['ordering'])? $this->post['ordering']:'');?>">
					<div class ="error"><?php echo (isset($this->error['ordering']) ? $this->error['ordering'] :'')?></div>
				</div>
				<hr>
            		<div class ="action">
            		<a class ="add" id ="add" href ="#">Add Group</a>
            		<a class ="cancel" href ="index.php?controller=group&action=show<?php echo $page_current;?>">Cancel</a>
            		</div>
			</form></div>
</div>