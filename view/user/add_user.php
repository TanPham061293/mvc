<div class ="content">
<h1>Edit User</h1>
		<div class ="table">
		<?php 
		
		$select1 ='';
		$select2 ='';
		if (isset($this->result['sex'])){
		    if ($this->result['sex'] == 0){
		        $select1 ="selected ='selected'";
		    }else{
		        $select2 ="selected ='selected'";
		    }
		}
		$page_current = (isset($_GET['page']) ? '&page='.$_GET['page'] :'');
		?>
		<script type="text/javascript">
			$(document).ready(function(){
                    $('#add').click(function(){
                    	$('#form').submit();
                    })
				})
		</script>
			<form action="#" method ="post" name ="form_user" id ="form">
			<div class ="notice">
			<?php echo (isset($this->notice) ? $this->notice : '');?>
			</div>
				<div class ="row">
				<br>					
					<p><b>First Name:</b></p>
					<p><input type ="text" name ="first_name" placeholder ="Nhập vào tên gọi." 
					value ="<?php echo (isset($this->result['first_name']) ? $this->result['first_name'] : '');?>" >	</p>
					<div class ="error"><?php echo (isset($this->error['first_name'])?$this->error['first_name'] :'')?></div>
					<p><b>Last Name:</b></p>
					<p><input type ="text" name ="last_name" placeholder ="Nhập vào họ và tên đệm." 
					value ="<?php echo (isset($this->result['last_name']) ? $this->result['last_name'] : '');?>"></p>
					<div class ="error"><?php echo (isset($this->error['last_name'])?$this->error['last_name'] :'')?></div>
					<p><b>Birthday:</b></p>
					<p><input type ="date" name ="birthday" 
					value ="<?php echo (isset($this->result['birthday']) ? $this->result['birthday'] : '');?>"></p>
					<div class ="error"><?php echo (isset($this->error['birthday'])?$this->error['birthday'] :'')?></div>
					<p><b>Sex:</b></p>
					<p><select name ="sex">
						<option value = '2'>Select Sex:</option>
						<option value = '0' <?php echo $select1; ?>>Nữ</option>
						<option value = '1' <?php echo $select2; ?>>Nam</option>
						
										</select></p>
					<p><b>Address:</b></p>	
					<p><input type ="text" name ="address" placeholder ="Nhập địa chỉ hiện tại." 
					value ="<?php echo (isset($this->result['address']) ? $this->result['address'] : '');?>"></p>
					<div class ="error"><?php echo (isset($this->error['address'])?$this->error['address'] :'')?></div>
					<p class ="name" ><b>User Name</b></p>
					<p><input type ="text" name = "user_name" placeholder ="Nhập tên đăng nhập." 
					value ="<?php echo (isset($this->result['user_name']) ? $this->result['user_name'] : '');?>">
					<div class ="error"><?php echo (isset($this->error['user_name'])?$this->error['user_name'] :'')?></div>
					<p><b>Password:</b></p>
					<p><input type ="password" name = "pass_word" placeholder ="Nhập mật khẩu đăng nhập."></p>
					<div class ="error"><?php echo (isset($this->error['pass_word'])?$this->error['pass_word'] :'')?></div>
					<p><b>Group Name:</b></p>
					<p><select name ="group_id">
					<option>Select Group</option>
					<?php echo $this->option?>
					</select></p>
					<p><b>Email:</b></p>	
					<p><input type ="text" name ="email" placeholder ="Nhập địa chỉ email." autocomplete ="off" 
					value ="<?php echo (isset($this->result['email']) ? $this->result['email'] : '');?>"></p>	
					<div class ="error"><?php echo (isset($this->error['email'])?$this->error['email'] :'')?></div>
				</div>
				<br>
				<hr>
            		<div class ="action">
            		<input type ="hidden" value ="hidden">
            		<a class ="add" id ="add" href ="#">Add</a>
            		<a class ="cancel" href ="index.php?controller=user&action=show<?php echo $page_current;?>">Cancel</a>
            		</div>
			</form>
				
            </div>
</div>