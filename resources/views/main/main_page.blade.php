<x-layout>
	<x-slot:title>
		main_title
	</x-slot>
	<h2 class="main_title"> Главная страница </h2>

	<form id="mail_form">
		<h2 class="form_title">Отправить письмо</h2>

		<input class="required" type="text" name="name" placeholder="Имя">
	
		<input class="required phone" type="text" name="phone" placeholder="Телефон">

		<button id="submit_main_form">Отправить</button>
	</form>

	<div id="weather_form">
		
	</div>

	<?php if($user != null): ?>
		<h3 class="form_title">Вы вошли как:<br>{{ $user->login }}</h3>
		<button id="go_out">Выйти</button>
	<?php endif; ?>

</x-layout>