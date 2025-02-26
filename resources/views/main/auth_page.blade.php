<x-layout>
	<x-slot:title>
		auth_page
	</x-slot>
	
    <h2 class="main_title">Авторизация</h2>
	<form id="auth_form">
		<input type="text" placeholder="Логин" name="login" class="required">
		<input type="password" placeholder="Пароль" name="password" class="required">
		<button id="auth_butt">Авторизоваться</button>
		<div class="error_text hide">
			Не правильно ввели логин или пароль
		</div>
	</form>

</x-layout>