<div class ="content">
<h1>Detail User</h1>
<script type="text/javascript">

function deleteRow(id) {
	$("#dialog-confirm").dialog({
		resizable : false,
		height : 200,
		modal : true,
		buttons : {
			"Yes" : function() {
				$.post('index.php?controller=user&action=delete', {id : id	}, function(data) {
					$('#form_user').html(data);
				});
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});	
}

</script>
		<div class ="table">
		<?php 
		$fullname ='';
		if (isset($this->data['first_name']) || isset($this->data['last_name'])){
		    $fullname .= $this->data['last_name'] .' '.$this->data['first_name'];
		}
		$page_current = (isset($_GET['page']) ? '&page='.$_GET['page'] :'');
		$page         = (isset($_GET['page']) ? $_GET['page'] :'');
		?>
			<form action="#" method ="post" name ="form_user" id ="form_user">
			<div id="dialog-confirm" title="Thông báo!" style="display: none;">
          		<p>Bạn có chắc muốn xóa phần tử này hay không?</p>
        	</div>
				<div class ="row">
					<p><b>First Name:</b><label><?php echo (isset($this->data['first_name']) ? $this->data['first_name'] : '');?>		</label>    </p>
					<p><b>Last Name :</b><label><?php echo (isset($this->data['last_name'])  ? $this->data['last_name'] : '');?>		</label>	</p>	
					<p><b>Full Name :</b><label><?php echo $fullname?>		</label>    </p>
					<p><b>Birthday  :</b><label><?php echo (isset($this->data['birthday'])   ? date('d-m-Y',strtotime($this->data['birthday'])) : '');?></label></p>	
					<p><b>Sex       :</b><label><?php echo (isset($this->data['sex'])        ? ($this->data['sex'] == 0 ? 'Nữ' :"Nam") : '');?></label>	</p>
					<p><b>Address   :</b><label><?php echo (isset($this->data['address'])    ? $this->data['address'] : '');?>			</label>	</p>
					<p><b>User Name :</b><label><?php echo (isset($this->data['user_name'])  ? $this->data['user_name'] : '');?>		</label>    </p>
					<p><b>Group Name:</b><label><?php echo (isset($this->data['name'])       ? $this->data['name'] : '');?>				</label>    </p>
					<p><b>Email     :</b><label><?php echo (isset($this->data['email'])      ? $this->data['email'] : '');?>			</label>	</p>		
				</div>
				<br><br>
				<hr>
				<div class ="action">
            		<a class ="delete" href ="javascript:deleteRow(<?php echo (isset($this->data['id']) ? $this->data['id'] : '')?>)">Delete</a>
            		<a class ="cancel" href ="index.php?controller=user&action=show<?php echo $page_current;?>">Cancel</a>
            		<input type ="hidden" name ="hidden">
            		</div>	
			</form>
			
			</div>
</div>
