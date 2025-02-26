<h2 class="form_title">Cписок категорий</h2>

<div class="cats_list">
@foreach ($cats as $item)
	<a class="cats_item" href="{{ route('posts').'/'.str_slug($item['name']); }}">
		{{ $item['name'] }}
	</a>
@endforeach
<a class="cats_item" href="/post/">Все</a>
</div>