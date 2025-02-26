<x-layout>
	<x-slot:title>
		{{ $post['name']; }}
	</x-slot>
	<h2>{{ $post['name']; }}</h2>
	<p>
		{{ $post['desc']; }}
	</p>
</x-layout>  