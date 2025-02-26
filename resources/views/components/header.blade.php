<?php
	use Illuminate\Support\Facades\Auth;
	$chek_auth = Auth::check();
	$this_user = Auth::user();
	$check_admin = (($this_user != null) and ($this_user->role == 1));

	$URL = url()->current();

	function Return_Class($cur_url, $page_url)
	{
		$class = ($cur_url == $page_url) ? 'active' : null;
		return $class;
	}	
?>
<header>
	<ul class="menu wrap">
		<li>
			<a class="<?= Return_Class($URL, route('main')); ?>" href="{{ route('main'); }}">Главная</a>
		</li>

		<?php if($chek_auth): ?>
		<li>
			<a class="<?= strpos($URL, route('posts')) === false ? null : 'active'; ?>" href="{{ route('posts'); }}">Посты</a>
		</li>
		<?php endif; ?>

		<?php if(!$chek_auth): ?>
			<li>
				<a class="<?= Return_Class($URL, route('registration')); ?>" href="{{ route('registration'); }}">Регистрация</a>
			</li>
		<?php endif; ?>

		<?php if(!$chek_auth): ?>
			<li>
				<a class="<?= Return_Class($URL, route('auth')); ?>" href="{{ route('auth'); }}">Авторизация</a>
			</li>
		<?php endif; ?>

		<?php if($check_admin): ?>
			<li>
				<a class="<?= Return_Class($URL, route('admin')); ?>" href="{{ route('admin'); }}">Панель администратора</a>
			</li>
		<?php endif; ?>

		<?php if($check_admin): ?>
			<li>
				<a class="<?= Return_Class($URL, route('users_list')); ?>" href="{{ route('users_list'); }}">Список пользователей</a>
			</li>
		<?php endif; ?>
	</ul>
</header>

