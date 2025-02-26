<x-layout>
	<x-slot:title>
		Админка
	</x-slot>
	
    <h2 class="main_title">Панель администратора</h2>
	<h3 class="main_title">Вы вошли как: {{ $user == null ? '' : $user['login'] }}</h3>
	<button id="go_out">Выйти</button>

	<div class="post_box" id="posts_box_admin">
		
	</div>

	
</x-layout>