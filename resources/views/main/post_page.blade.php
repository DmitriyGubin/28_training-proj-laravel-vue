<x-layout>
	<x-slot:title>
		post_title
	</x-slot>
	<h2 class="main_title cat">Все посты</h2>
	<x-cats/>
	<x-posts catigory="all" :req="$req" />
</x-layout> 