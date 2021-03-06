<?php
/* 
-----------------------------------
 This is Server Part
 Серверная часть
 Ilya Bobkov 2017
----------------------------------- */
include "php/class.msg.php";
include "php/class.mysqli.php";
include "php/class.util.php";
include "php/class.user.php";
include "php/class.record.php";
include "php/class.search.php";
include "php/class.lang.php";
include "php/class.text.php";
include "php/class.bookmark.php";
include "php/class.writer.php";
include "php/class.categories.php";

session_start();

/* ------------- [ одиночки ] ------------- */
$db			= DataBase::getDB();
$user		= User::getUser();	
$rec 		= Record::getRecord();	
$search		= Search::getSearch();
$text		= Text::getText();
$bookmark	= BookMark::getBookMark();
$writer		= Writer::getWriter();
$categories	= Categories::getCategories();
$lang		= Lang::getLang();

/* -------------- [ роутинг ] -------------- */
switch(strtoupper($_SERVER["REQUEST_METHOD"])) {	
	case "GET": {	
		if (isset($_GET["func"])) {    			    								
			switch ($_GET["func"]) 	 {							
				/* -- пользователь -- */
				case "SRV_AuthUser": {
					$user->auth(); 		
					break;
				}				
				/* -- пользователь -- */
				case "SRV_AuthFromVK": {
					$user->authFromVK(); 		
					break;
				}	
				/* -- записи -- */
				case "SRV_UpdateRecord": {
					$rec->update();		
					break;	
				}
				case "SRV_DeleteRecord": {
					$rec->del();
					break;    		
				}
				case "SRV_GetRecords": {
					$rec->getRecords(); 
					break;
				}			
				case "SRV_GetRecordList": {
					$rec->getList();
					break;
				}
				case "SRV_ReadText": {		
					$text->read();					
					break;
				}			
				case "SRV_ReadFullText": {		
					$text->readFullText();					
					break;
				}
				case "SRV_GetTextFullSize":{
					$text->getFullSize();					
					break;
				}
				case "SRV_GetLastSymbols":{
					$text->getLastSymbols();					
					break;
				}				
				/* -- закладки -- */
				case "SRV_GetBookMark": {		
					$bookmark->get();					
					break;
				}			
				case "SRV_GetBookMarks": {		
					$bookmark->getBookMarks();					
					break;
				}
				/* -- работы автора -- */
				case "SRV_GetWriterWorks": {		
					$writer->getWorks();					
					break;
				}				
				/* -- категории -- */
				case "SRV_GetCategories": {		
					$categories->getAll();					
					break;
				}				
				case "SRV_GetCategoryFromId": {		
					$categories->getFromId();					
					break;
				}
				/* -- лайк -- */
				case "SRV_SetLike": {		
					$rec->setLike();					
					break;
				}
				/* -- кол-во лайков -- */
				case "SRV_GetLikes": {		
					$rec->getLikes();					
					break;
				}				
				/* -- восстановить пароль -- */
				case "SRV_RestorePassword": {		
					$user->restorePassword();					
					break;
				}
				/* -- установить язык --*/
				case "SRV_SetLanguage": {		
					$lang->setLanguage();					
					break;
				}
				/* -- получить содержимое страницы --*/
				case "SRV_GetStrings": {		
					$lang->getStrings();					
					break;
				}
			}
		}
	break;
	}	
	case "POST": {	
		if (isset($_POST["func"])) 
		{    			    							
			switch ($_POST["func"]) 
			{
			        case "SRV_RegUser": {
					$user->register(); 	
					break;
				}				
				/* -- обновить информацию -- */
				case "SRV_UpdatePersonalInfo": {
					$user->update(); 	
					break;
				}				
			        /* -- загрузка или обновление записи -- */
				case "SRV_ProcessRecord": {				
					switch($_POST["mode"]) {
						case "new":  $rec->add();    break;
						case "edit": $rec->update(); break;
					}
					break;    		
				}				
				/* -- закладка -- */
				case "SRV_SetBookMark": {
					$bookmark->set();
					break;    		
				}
				
				/* -- режим отображения записи -- */
				case "SRV_SetPrivateMode": {
					$rec->setPrivateMode();
					break;    		
				}				
			}		
		}
	  break;
	}
}
?>