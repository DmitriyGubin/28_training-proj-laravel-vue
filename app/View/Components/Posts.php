<?php

 namespace App\View\Components;

 use Illuminate\View\Component;

 use App\Models\per;

 use Illuminate\Http\Request;

 class Posts extends Component
 {
 	public $catigory;
 	private $num_per_page = 2;
 	private $sort_field = 'id';
 	private $sort_method = 'asc';
 	public $req;

 	public function __construct($catigory,$req)
 	{
 		$this->catigory = $catigory;
 		$this->req = $req;

 		if($req->filled('sort') and $req->filled('method'))
 		{
 			$this->sort_field = $req->get('sort');
 			$this->sort_method = $req->get('method');
 		}
 	}

 	public function Getdata()
	{
		$query = per::query();

		$req = $this->req;

		if ($req->filled('one_from')) 
		{
			$query = $query->where('prop_one', '>=', $req->get('one_from'));
		}

		if ($req->filled('one_to')) 
		{
			$query = $query->where('prop_one', '<=', $req->get('one_to'));
		}

		if ($req->filled('two_from')) 
		{
			$query = $query->where('prop_two', '>=', $req->get('two_from'));
		}

		if ($req->filled('two_to')) 
		{
			$query = $query->where('prop_two', '<=', $req->get('two_to'));
		}

		if ($this->catigory != 'all')
		{
			$query = $query->where('cats_id', '=', $this->catigory);
		}

		$data = $query -> orderBy($this->sort_field, $this->sort_method)
		-> paginate($this->num_per_page)
		-> appends(request()->except('page'));

		return $data;
	}

 	public function render()
 	{
 		return view('components.posts', [
 			'pers' => ($this -> Getdata()),
 			'req' => ($this->req)
 		]);
 	}
 }

