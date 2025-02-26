<div class="opt_box">
	<h2 class="form_title">Сортировка</h2>
	<div class="flex_line">
		<a class="sort_item" href="{{ $req->fullUrlWithQuery(['sort' => 'sort_order', 'method' => 'asc']) }}">По возрастанию</a>
		<a class="sort_item" href="{{ $req->fullUrlWithQuery(['sort' => 'sort_order', 'method' => 'desc']) }}">По убыванию</a>
	</div>
</div>

<div class="opt_box">
	<h2 class="form_title">Фильтрация</h2>
	<form method="GET">
		<div>
			<input placeholder="Свойство_1 от" type="text" name="one_from" value="<?= $_GET['one_from'] ?? ''; ?>">
			<input placeholder="Свойство_1 до" type="text" name="one_to" value="<?= $_GET['one_to'] ?? ''; ?>">
		</div>

		<div>
			<input placeholder="Свойство_2 от" type="text" name="two_from" value="<?= $_GET['two_from'] ?? ''; ?>">
			<input placeholder="Свойство_2 до" type="text" name="two_to" value="<?= $_GET['two_to'] ?? ''; ?>">
		</div>
		<button>Отфильтровать</button>
	</form>
</div>

<h2 class="form_title">Посты</h2>

@foreach ($pers as $item)
@if (isset($item->category->name))
	<a class="opt_box" href="{{ route('posts').'/'.str_slug($item->category->name).'/'.str_slug($item['name']); }}">
		<h2 class="form_title">Haзвание: {{ $item['name'] }}</h2>
		<div class="prop_item">Порядок сортировки: {{ $item['sort_order'] }}</div>
		<div class="prop_item">Свойство_1: {{ $item['prop_one'] }}</div>
		<div class="prop_item">Свойство_2: {{ $item['prop_two'] }}</div>
	</a>
@endif
@endforeach

{{ $pers->links() }}