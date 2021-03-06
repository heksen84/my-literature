/*
------------------------------
 Ilya Bobkov 2017(c) 
 https://github.com/heksen84
------------------------------*/
$(document).ready(function() 
{			
    sweetAlertInitialize();	
	
    /* 
	---------------------------
     обновить таблицу
    --------------------------- */
    function UpdatePostedTextsTable()
    {	
		var i = 1;
        var num_strings = $("#posted_table tr").length;
        $("#posted_table tbody tr td:first-child").each(function() 
		{
            if (i != num_strings) $(this).html(i);
            i++;
        });       
	}
	
	/* -- режим отображения -- */
	function SetPrivateMode(element, record_id, mode)
	{		
		$.ajax
		({
			url: "..//server.php",
			data: {	"func": "SRV_SetPrivateMode", "record_id": record_id, "mode": mode }, method: "POST", async:false,
		}).done(function( data )				
		{																			
			var obj = jQuery.parseJSON(data);					
			switch(obj.answer)
			{
				case "error": error(obj.string); break;
				case "warning": warning(obj.string); break;
				case "success": 
				{							
					switch(mode) 
					{
						case 0: $(element).html("<img src='img/eye1.png' class='img-fluid eye_icon'>").attr("title","отображается"); break;
						case 1:
						{
							$(element).find(".eye_icon").hide();
							$(element).html("&nbsp;").attr("title", "не отображается");
							break;
						}												
					}
				}
			}		
		});
	}

	/* -- получить список работ -- */	
	$.ajax
	({
		url: "..//server.php",
		data: {	"func": "SRV_GetWriterWorks" },		
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
					$("#tbody").append("<tr data-id='"+item.id+"'><td>"+(i+1)+"</td><td class='table_item'><div class='title_cell'>"+item.title+"</div></td><td><div class='like_cell'>0</div></td><td class='display_cell' title='не отображается'>&nbsp;</td><td class='delete_record' title='удалить запись'>X</td></tr>");
					if (item.access_mode!=1) $(".display_cell").eq(i).html("<img src='img/eye1.png' class='img-fluid eye_icon' title='отображается'>");										
				});

				/* -- лайки -- */
				$.each(obj.string, function(i, item) 
				{					
					$.ajax
					({
						url: "..//server.php",
						data: 
						{
							"func": "SRV_GetLikes",                    
							"record_id": item.id,			
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
								$("#tbody tr").eq(i).find(".like_cell").text(obj.string);
								break;
							}
						} 
					});					
				});
				
				/* показать запись в редакторе */
				$(".table_item").click(function() {
					localStorage.setItem("read_data_id", $(this).parent().data("id"));
					$(location).attr('href', "writer.php");
				});
				
				/* режим отображения */
				$(".display_cell").click(function() {
					if ($(this).html()!="&nbsp;") {												
						SetPrivateMode($(this), $(this).parent().data("id"), 1 );						
					}
					else {						
						SetPrivateMode($(this), $(this).parent().data("id"), 0 );
					}
				});
				
				/* удалить запись */
				$(".delete_record").click(function() {
					var element = $(this);										
					swal
					({	
						title: "Удалить запись?",
						text: $(this).parent().find(".table_item").text(),
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Да",
						cancelButtonText: "Нет",
						closeOnConfirm: true,
						closeOnCancel: true,
						allowEscapeKey:	true
					},
					function(isConfirm) 
					{
						if (isConfirm) 
						{							
							$.ajax
							({
								url: "..//server.php",
								data: {	"func": "SRV_DeleteRecord", "record_id": element.parent().data("id") }, 
							}).done(function( data )				
							{									
								var obj = jQuery.parseJSON(data);					
								switch(obj.answer)
								{
									case "error":   alert(obj.string); break;
									case "warning": alert(obj.string); break;
									case "success": 
									{	
										element.parent().remove();
										UpdatePostedTextsTable();
									}
								}
							});														
						}
					});					
				});
			}			
		}				
	});
});