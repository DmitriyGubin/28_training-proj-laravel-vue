<x-layout>
	<x-slot:title>
		{{ $cat_name }}
	</x-slot>
	<h2 class="main_title cat">Категория: {{ $cat_name }}</h2>
	<x-cats/>

	<x-posts :req="$req" :catigory="$cat_id" />

</x-layout> 