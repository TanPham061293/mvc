<!DOCTYPE html>
<html>
<head>
<meta charset="${encoding}">
<link type ="text/css" href ="format\css\layout.css" rel ="stylesheet">
<link type ="text/css" href ="format\css\jquery-ui-1.10.3.custom.min.css" rel ="stylesheet">
<script type="text/javascript" src ="format\js\jquery-1.10.2.min.js"></script>
<script type="text/javascript" src ="format\js\jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src ="format\js\js_generic.js"></script>
<script type="text/javascript">
function logout() {
	$("#dialog-confirm1").dialog({
		resizable : false,
		height : 200,
		modal : true,
		buttons : {
			"Yes" : function() {
				$('.layout').load('index.php?controller=logout');
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});	
}
function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}
$(document).ready(function(){
	
	var controller = (getUrlVar('controller')=='') ? "home" : getUrlVar('controller');
	$('div.layout a.' + controller).addClass('active');
	
})
</script>

<title>MVC.</title>
</head>
<body>
	<div id="dialog-confirm1" title="Thông báo!" style="display: none;">
          		<p>Bạn có chắc muốn Thoát?</p>
        	</div>
	<div class ="layout">
	<?php 
	@Session::init();
	$menu = '<a href ="index.php?controller=home&action=show" class="home">Home </a>';
	if (Session::get('login')==true){
	  $menu .= '<a href ="index.php?controller=group&action=show" class="group">Group</a>
    			<a href ="index.php?controller=user&action=show" class="user">User   </a>
    			<a href ="javascript:logout()" >Logout</a>' ; 
	}else{
	    $menu .= '<a href ="index.php?controller=login&action=show" class="login">Login</a>';
	}
	?>
		<div class ="header">
		
			<?php 
			echo $menu;?>
			
			</div>
		
		