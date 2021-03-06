﻿<!-- авторизация -->
<div class="modal fade" id="AuthWindow">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" style="margin:auto">авторизация</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="закрыть">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">	          				
		<label for="auth_email">Email</label>
		<input type="email" class="form-control input" id="auth_email" placeholder="Введи email">
		<label for="auth_password">Пароль</label>
		<input type="password" class="form-control input" id="auth_password" placeholder="Введи пароль">
		<a href="#" class="nav-link" id="reg_link">регистрация</a>
		<a href="#" class="nav-link" id="password_restore_link">не помню пароль</a>
      </div>		
		<div class="col-md-12 text-center" id="label_auth_col"><div style="font-size:12px">вход через</div><img src="pages/img/vk_logo.png" class="social_img"/></div>
      <div class="modal-footer" style="margin: 10px auto;">
        <button type="button" class="btn btn-primary" id="button_auth" style="margin: 0px auto;">вход</button>        
      </div>
    </div>
  </div>
</div>
<!-- регистрация -->
<div class="modal fade" id="RegWindow">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" style="margin:auto">регистрация</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="закрыть">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">	          
		<select class="form-control" id="reg_user_type">
		<option value="0">Я читатель</option>			
		<option value="1">Я писатель</option>		
		</select>
		<label for="reg_login" id="label_name">Логин</label>
		<input type="text" class="form-control input" id="reg_login" placeholder="Введи логин" title="введи уникальное имя">				
		<label for="reg_email">Email</label>
		<input type="email" class="form-control input" id="reg_email" placeholder="Введи email">
		<label for="reg_password" id="label_password">Пароль</label>
		<input type="password" class="form-control input" id="reg_password" placeholder="Введи пароль">
      </div>
      <div class="modal-footer" style="margin:auto">
        <button type="button" class="btn btn-primary" id="button_reg">продолжить</button>        
      </div>
    </div>
  </div>
</div>
<!-- восстановить доступ -->
<div class="modal fade" id="PasswordRestoreWindow">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" style="margin:auto">восстановить доступ</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="закрыть">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">	          				
		<label for="restore_email">Email</label>
		<input type="email" class="form-control input" id="restore_email" placeholder="Введи email">		
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="button_restore_access">восстановить</button>        
      </div>
    </div>
  </div>
</div>
</div>