
$(document).ready(function(){	
	$('#delete').click(function(){
		$('#form').submit();
		
	});
	$('#add').click(function(){
		$('#form').submit();
		
	});	
	
	$('#notice_once').click(function(){
		$('#notice_once').hide(500);
	});
	$('#check_all').change(function(){
		var checkStatus = this.checked;
		$('#form').find(':checkbox').each(function(){
			this.checked = checkStatus;
		});
    });	
	
})