<?php

 namespace App\View\Components;

 use Illuminate\View\Component;

 use App\Models\Cats as cats_model;

 class Cats extends Component
 {
 	public function render()
 	{
 		$cats = cats_model::all();
 		return view('components.cats', [
 			'cats' => $cats,
 		]);
 	}
 }

