<div class ="content">
<?php 
$value ="";
if (isset($this->post['user_name'])){
    $value = $this->post['user_name'];
}
?>
<h1>LogIn</h1>
		<div class ="table">
			<form action="#" method ="post">
    			<div class ="row">
    			<div class ="notice"><?php echo (isset($this->notice['notice']) ? $this->notice['notice'] :''); ?></div>
        			<p><b>User Name:</b></p>
        			<p><input type ="text" name ="user_name" placeholder ="user: Admin." value ="<?php echo $value;?>"></p>
        			<div class ="error"><?php echo (isset($this->notice['error_user_name']) ? $this->notice['error_user_name'] :''); ?></div>
        			<p><b>Password:</b></p>
        			<p><input type ="password" name ="password" placeholder =" pass: 1 ."></p>
        			<div class ="error"><?php echo (isset($this->notice['error_password']) ? $this->notice['error_password'] :''); ?></div>
    			</div>
        			<div class ="action">
        			<input type ="submit" name ="submit" id ="submit" value ="Login" class ="submit">
        			<input type ="reset" value ="Reset" class ="reset">
        			</div>
			</form>
		</div>
</div>
