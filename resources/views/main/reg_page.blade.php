<x-layout>
	<x-slot:title>
		auth_page
	</x-slot>
	
    <h2 class="main_title">Регистрация</h2>
	<p class="about_reg">Для пользования ресурсами сайа надо зарегистрироваться</p>
	<form id="registr_form">
		<input type="text" placeholder="Логин" name="login" class="required login">
		<input type="password" placeholder="Пароль" name="password" class="required password">
		<button id="register_butt">Зарегистрироваться</button>
		<ul class="reg_list">
			<li>
				Пароль должен состоять минимум из 6 символов, содержать цифру, 
				содержать заглавную и строчную буквы английского алфавита, содержать cимвол, 
				не являющийся буквенно-цифровым.
			</li>

			<li>
				Логин миниму 5 символов
			</li>
		</ul>
		<div class="error_text hide">
			Такой пользователь уже есть в базе
		</div>
	</form>


</x-layout>