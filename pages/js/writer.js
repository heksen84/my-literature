﻿/*
------------------------------
 Ilya Bobkov 2017(c) 
 https://github.com/heksen84
------------------------------*/
var max_symbols 	= 100000;
var max_image_size 	= 1700000;
var max_text_size 	= 100;

/*----------------------------
   загрузить изображение 
  ----------------------------*/
function handleLoadImage(evt)
{			
	var reader = new FileReader();
	var files = evt.target.files;
	f = files[0];
	if (!f.type.match("image.*")) 
	{
        error("только изображения");
		return;
    }
	reader.onload = (function(theFile) 
	{
		return function(e) 
		{            
		
			var str = e.target.result.trim();			
			if (str.length > max_image_size)
			{
				error("Большой размер");				
			}
			else
			$("#cover_image").attr("src", e.target.result );
		};
	})(f);
	
	reader.readAsDataURL(f);
}

/*
----------------------------------
 JQUERY
----------------------------------*/	
$(document).ready(function() 
{								
	sweetAlertInitialize();
	BlurInput();
	
	$("#user_name").text("Привет, "+localStorage.getItem("user_name")+"!");			
	document.getElementById("cover").addEventListener("change", handleLoadImage, false);	
	
	$("#writer_quit").click(function() 
	{				
		$(location).attr('href', "/");		
	});				
	
	$( window ).resize(function() 
	{			
		if ($(window).width() > 576)
		{
			$("#editor").css("height", $(window).height()-150);
			$("#short_description").css("height", "100");		
		}
		else $("#editor").css("height", "440px");					
	}).trigger("resize");
	
	
	/* --- редактор ввод --- */
	$("#editor").keyup(function() 
	{		
		var editor = $(this).val();
		var length = editor.length;		
		
		if(editor.length <= max_symbols) {
			$("#info_panel").html("Символов:&nbsp;"+length);
		}
		else {			
			swal('Места больше нет!!!');			
		}		
	});	
	
	/* -- переключатель доступа записи -- */
	$( "#record_show_mode" ).change(function() 
	{
		if ($(this).val() == 1) $("#button_add_record").text("сохранить");
		else $("#button_add_record").text("опубликовать");
		
		if ($(this).val() == 2) 		
			$("#price_label, #price, #currency").show();		
		else 		
			$("#price_label, #price, #currency").hide();		
	}).trigger("change");
	
	$("#price").float();
	
	/*
	--------------------------------------------	
	
	РЕЖИМ РЕДАКТИРОВАНИЯ		

	--------------------------------------------*/
	function CheckEditMode()
	{									

		$("#title, #short_description, #editor, #price").val("");
		localStorage.setItem("writer_record_mode", "new");		
		
		if(localStorage.getItem("read_data_id") != "")
		{						
			$.ajax
			({
				url: "..//server.php",
				data: 
				{
					"func": "SRV_ReadText",                    
					"record_id": localStorage.getItem("read_data_id"),
				},
				async:false,
			}).done(function( data ) 
			{									
				var obj = jQuery.parseJSON(data);				
				switch(obj.answer) 
				{
					case "error": error(obj.string); break;
					case "warning": warning(obj.string); break;
					case "success": {							
						localStorage.setItem("writer_record_id", obj.string[0].id),
						$("#title").val(obj.string[0].title);
						$("#short_description").val(obj.string[0].description);
						if (obj.string[0].cover!="")
						$("#cover_image").attr("src","../"+obj.string[0].cover);
						$("#editor").val(obj.string[0].text);
						$("#info_panel").html("Символов:&nbsp;"+$("#editor").val().length);					
						$("#type_of_literature").val(obj.string[0].type_literature);
						$("#record_show_mode").val(obj.string[0].show_mode);
					}
				} 
		
				localStorage.setItem("writer_record_mode", "edit");
				localStorage.setItem("read_data_id", "");
			});		
		}
	}
	
	
	/*
	-------------------------------
	получить категории
	-------------------------------*/
	$.ajax
	({
		url: "..//server.php",
		data: 
		{
			"func": "SRV_GetCategories",		
		},
	}).done(function( data ) 
	{			
		var obj = jQuery.parseJSON(data);
		switch(obj.answer)
		{				
			case "error": error(obj.string); break;
			case "warning": warning(obj.string); break;
			case "success": 
			{		
				$.each(obj.string, function(i, item) 
				{
					$("#type_of_literature").append("<option value='"+item.id+"'>"+item.name+"</option>");			
				});				
				CheckEditMode();
			}
		}			
	});	


	// ---------------------------
	// Меню
	// ---------------------------
	$("#menu li").click(function() 
	{
		$("#menu li").css("font-weight", "");
		$(this).css("font-weight", "bold");
		switch($(this).index())
		{
			case 0: ShowBookMarks(); break;
			case 1: ShowUserData(); break;
			case 2: $(location).attr('href', "/"); break;
		}
	}).eq(0).click(); // сразу кликнуть
		
	/*
	------------------------------------------
	сохранить запись
	------------------------------------------*/
	$("#button_add_record").click(function() {	
				
		if ($("#editor").val()=="")
		{						
			$("html, body").animate({scrollTop:0}, "fast");
			$("#editor").focus();			
			warning("введите текст");
		}
		else
		if ($("#title").val()=="")
		{
			$("#title").focus();	
			warning("введите название");
		}
		else
		if ($("#short_description").val()=="")
		{
			$("#short_description").focus();	
			warning("введите описание");
		}		
		else
		if ($("#price").val()=="" && $( "#record_show_mode" ).val() == 2) 
		{
			$("#price").focus();
			warning("введите цену");
		}		
		else 
		{			
			NProgress.start();			
			$.ajax
			({
				url: "..//server.php",
				data: 
				{
					"func": "SRV_ProcessRecord",													
					"id": localStorage.getItem("writer_record_id"),
					"image": $("#cover_image").attr("src"),
					"title": $("#title").val(),
					"short_description": $("#short_description").val(),
					"text": $("#editor").val(),
					"type_of_literature": $("#type_of_literature").val(),
					"record_show_mode": $("#record_show_mode").val(),
					"price": $("#price").val(),
					"mode": localStorage.getItem("writer_record_mode"),
				
				}, method: "POST",
			}).done(function( data )				
			{												
				alert(data);
				var obj = jQuery.parseJSON(data);				
				switch(obj.answer)
				{
					case "error": error(obj.string); break;
					case "warning": warning(obj.string); break;
					case "success": 
					{
						success(obj.string);
						$("#cover_image").attr("src", "");
						$("input:text, textarea").val("");						
					}
				}
				NProgress.done();		
			});        
		}
	});
});