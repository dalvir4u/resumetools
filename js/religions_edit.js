function delete_section (oid, sid, rid){
	var x = confirm("Are you sure you want to remove this");
	if(x==true){
	var postdata = 'form_id=delete_section&rid='+rid+'&section='+sid;
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){

		}
	);
	$('#recordsArray_'+oid).remove();	
	}
}
function resumePages(num, id){
	//var language=document.getElementById("language_sel").value;
	$('#qwe3').html('<center><img src="images/resume-loader.gif" /></center>');
	var postdata = 'form_id=change_template&rid='+id+'&temp='+num;
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){

		}
	);
	$('.tempimg').removeClass("tempactive");	
	$('#qwe3').load('displayresume.php?id='+id);
	$('#edit_resume_auto').load('resumecreate.php?id='+id+' #edit_resume_auto');
	$('#'+num).addClass("tempactive");
}
function submitform(id, form, msgbox){
	var error=0;
	$('#'+form+' .required').each(function(){
		if($(this).val()==""){
			error++;
			$(this).addClass("field_error");
		}else {
			$(this).removeClass("field_error");	
		}
	});
	if(error!=0){
		$('.'+msgbox).html("Please filled all required fields");
		return false;
	}
	$('#qwe3').html('<center><img src="images/resume-loader.gif" /></center>');
	var postdata = $('#'+form).serialize();
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){
			var browser=navigator.appName;
			if(browser=="Microsoft Internet Explorer")
			{
			   window.location.href='resumecreate.php?id='+id;
			}
			$('#qwe3').load('displayresume.php?id='+id);
			$('#edit_resume_auto').load('resumecreate.php?id='+id+' #edit_resume_auto');
			parent.jQuery.fancybox.close();
		}
	);		
}
function submitotherform(id, form, msgbox){
	var error=0;
	$('#'+form+' .required').each(function(){
		if($(this).val()==""){
			error++;
			$(this).addClass("field_error");
		}else {
			$(this).removeClass("field_error");	
		}
	});
	if(error!=0){
		$('#'+msgbox).html("<b>Error:</b> Field Required");
		return false;
	}
	$('#qwe3').html('<center><img src="images/resume-loader.gif" /></center>');
	var rid = $('#rid').val();
	var sid = $('#sid').val();
	var v = $('#ex').html();
	var editor = $('#singlechange').cleditor();
	editor[0].updateTextArea(editor, true);
	var postdata = $('#'+form).serialize();
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){
			var browser=navigator.appName;
			if(browser=="Microsoft Internet Explorer")
			{
			   window.location.href='resumecreate.php?id='+id;
			}
			$('#qwe3').load('displayresume.php?id='+id);
			$('#edit_resume_auto').load('resumecreate.php?id='+id+' #edit_resume_auto');	
			parent.jQuery.fancybox.close();
		}
	);	
	
}
function submiteduform(id, form, msgbox){
	var error=0;
	var editor = $('#desc_val').cleditor();
	editor[0].updateTextArea(editor, true);
	
	$('#'+form+' .required').each(function(){
		if($(this).val()==""){
			error++;
			$(this).addClass("field_error");
		}else {
			$(this).removeClass("field_error");	
		}
	});
	if(error!=0){
		$('.'+msgbox).html("Please filled all required fields");
		return false;
	}
	$('#qwe3').html('<center><img src="images/resume-loader.gif" /></center>');
	
	
	var postdata = $('#'+form).serialize();
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){
			var browser=navigator.appName;
			if(browser=="Microsoft Internet Explorer")
			{
			   window.location.href='resumecreate.php?id='+id;
			}
			$('#edit_resume_auto').load('resumecreate.php?id='+id+' #edit_resume_auto');
			$('#qwe3').load('displayresume.php?id='+id);
			parent.jQuery.fancybox.close();
		}
	);				
}
function submitexe_sumform(id, form, msgbox){
	var error=0;
	$('#'+form+' .required').each(function(){
		if($(this).val()==""){
			error++;
			$(this).addClass("field_error");
		}else {
			$(this).removeClass("field_error");	
		}
	});
	if(error!=0){
		$('.'+msgbox).html("Please filled all required fields");
		return false;
	}
	$('#qwe3').html('<center><img src="images/resume-loader.gif" /></center>');
	var editor = $('#singlechange').cleditor();
	editor[0].updateTextArea(editor, true);
	
	var editor1 = $('#editor1').cleditor();
	editor1[0].updateTextArea(editor1, true);
	
	var editor2 = $('#editor2').cleditor();
	editor2[0].updateTextArea(editor2, true);
	
	var postdata = $('#'+form).serialize();
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){
			var browser=navigator.appName;
			if(browser=="Microsoft Internet Explorer")
			{
			   window.location.href='resumecreate.php?id='+id;
			}
			$('#qwe3').load('displayresume.php?id='+id);
			$('#edit_resume_auto').load('resumecreate.php?id='+id+' #edit_resume_auto');
			parent.jQuery.fancybox.close();
		}
	);	
	
}
function print_resume(id){
	$.ajax({
		type:"GET",
		async: false,
		url: 'htmltopdf/dompdf/www/displayresume.php?id='+id,
		success: function(data) {
			var printcontent = data;
				child = window.open('', "", "height=700, width=500"); //Open the child in a tiny window.
				child.document.write('<html><body>'+printcontent+'</body></html>');
				window.focus(); //Hide the child as soon as it is opened.				
				child.print(); //Print the child.
				child.close(); //Immediately close the child.
				
		}
	});
}

function first_submit(){
	$err = 0;
	if($('#fname').val()==""){
		$err++;
		$('#fname').addClass("field_error");
		$('#fname_error').show();
	}else{
		$('#fname').removeClass("field_error");
		$('#fname_error').hide();
	}
	
	if($('#lname').val()==""){
		$err++;
		$('#lname').addClass("field_error");
		$('#lname_error').show();
	}else{
		$('#lname').removeClass("field_error");
		$('#lname_error').hide();
	}
	
	if($err == 0){
		var postdata = $('#createresumefirst').serialize();
		var url = "submit.php";
		$.post(url, postdata, 
			function(data){
				parent.jQuery.fancybox.close();
				$.fancybox( 
					{
						href : '#select_temp_block', 
						title : '&nbsp;', 
						helpers : {
									title: {
											type: 'outside',
											position: 'top'
									}
								  },
						'modal'          : true,
						'closeBtn '      : false,} 
				);
			}
		);
	
	}
	/*if($('input:radio[name=resume]:checked').val()=="new"){
		parent.jQuery.fancybox.close();
		$.fancybox( {href : '#select_temp_block', title : '&nbsp;', helpers : {
			title: {
				type: 'outside',
				position: 'top'
			}
		},
		'modal'          : true,
		'closeBtn '      : false,}
		);
	}else{			
		window.location.href="login.php";
	}*/
}
function second_submit(){
	var postdata = $('#createuser_first').serialize();
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){
			parent.jQuery.fancybox.close();
			$.fancybox( 
				{
					href : '#create_user_block', 
					title : '&nbsp;', 
					helpers : {
								title: {
										type: 'outside',
										position: 'top'
								}
		    				  },
		    		'modal'          : true,
		    		'closeBtn '      : false,} 
			);
		}
	);
	
}

function third_submit(){
	var postdata = $('#createuser_second').serialize();
	var url = "submit.php";
	$.post(url, postdata, 
		function(data){

		}
	);
	
}