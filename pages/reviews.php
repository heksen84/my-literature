﻿<!---------------------------- 
 Ilya Bobkov 2017(c) 
------------------------------>
<!DOCTYPE html>
<html lang="ru">
<head>
<title>МОЯ ЛИТЕРАТУРА&reg - литературный портал (книги онлайн, стихи, книги, прозы, рассказы)</title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<meta charset = "utf-8">
<meta name = "viewport" 	content	= "width=device-width"/>
<meta name = "description" 	content = "литературный ресурс"/>
<meta name = "keywords"    	content = "стихи, книги, рассказы, сказки, поэмы, статьи, писатель, поэт"/>
<meta name = "robots" 	   	content = "index, follow"/>
<meta name = "viewport" 	content = "width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- styles -->
<link href = "css/lib/bootstrap.min.css"	     	rel = "stylesheet"/>
<link href = "css/lib/tether.min.css"		     	rel = "stylesheet"/>
<link href = "css/lib/sweet-alert.css"   			rel	= "stylesheet"/>
<link href = "css/lib/scroll.css"	             	rel = "stylesheet"/>
<link href = "css/lib/nprogress.css"			   	rel = "stylesheet">
<link href = "css/writer.css<?php include "../php/debug.php"?>" 	rel	= "stylesheet"/>
<!-- libs -->
<script src = "js/lib/jquery-3.2.1.min.js"></script>
<script src = "js/lib/tether.min.js"></script>
<script src = "js/lib/bootstrap.min.js"></script>
<script src = "js/lib/sweet-alert.min.js"></script>      
<script src = "js/lib/jquery.util.js<?php include "../php/debug.php"?>"></script>  
<script src = "js/lib/jquery.msg.js"></script>          
<script src = "js/lib/jquery.float.js"></script>          
<script src = "js/lib/nprogress.js"></script>
<script src = "js/lib/moment.min.js"></script>
<script src = "js/writer.js<?php include "../php/debug.php"?>"></script>
</head>
<!-- меню -->
<nav class="navbar navbar-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
  aria-label="Toggle navigation" id="nav_bar_button" style="background:#1584ea">
  <span class="navbar-toggler-icon" style="font-size:14px;"></span>
  </button>
  <a class="navbar-brand" href="#" id="user_name">&nbsp;</a>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">            	  	  	
	<li class="nav-item">
        <a class="nav-link active" href="http://the-texts/pages/opros.php">Опрос</a>
    </li>
	<li class="nav-item active">
        <a class="nav-link" href="http://the-texts/pages/posted.php">Мои тексты</a>
    </li>   		
	<li class="nav-item active">
        <a class="nav-link" href="http://the-texts/pages/writer_settings.php">Настройки</a>
    </li>   
	<li class="nav-item active">
        <a class="nav-link" href="#" id="writer_quit">Выход</a>
    </li>      
    </ul>
  </div>
</nav>
<!-- контейнер -->
<div class="container-fluid" id="work_container">
<div class="row">
<div class="col-md-2">РЕКЛАМА</div>
<div class="col-md-7">
<!--<label for="load_text" id="label_cover" class="grey_shadow_text">загрузить текст</label>
<input type="file" id="load_text" name="fileupload" accept=".txt" style="margin-bottom:7px"/>-->
<textarea class="form-control" id="editor" placeholder="текст..."></textarea>
<div id="info_panel">&nbsp;</div>
</div>
<!-- ROW2 -->
<div class="col-md-3">
<label for="text" style="margin-top:10px" class="grey_shadow_text">Название</label>
<input type="text" class="form-control" maxlength="100" id="title">
<label for="short_description" class="grey_shadow_text">Краткое описание</label>
<textarea class="form-control" id="short_description"></textarea>
<label for="type_of_literature" class="grey_shadow_text">Тип литературы</label>
<select class="form-control" id="type_of_literature">
</select>
<label for="record_access_mode" class="grey_shadow_text">Доступ</label>
<select class="form-control" id="record_access_mode" style="width:200px;margin:auto">
<option value="0">открытый</option>
<option value="1">личный</option>	
<!--<option value="1">закрытый</option>
<option value="2">платный</option>-->	
</select>
<label for="price" id="price_label" style="display:none" class="grey_shadow_text">Цена</label>
<div id="price_block">
<input type="text" class="form-control" id="price" maxlength="8" style="width:125px;margin:auto;font-size:24px;display:none"></input>
<h4 id="currency" style="display:none" class="grey_shadow_text">руб.</h4>
</div>
<button class="btn btn-primary" id="button_add_record">опубликовать</button>
</div>
</div>
</div>
</html>
