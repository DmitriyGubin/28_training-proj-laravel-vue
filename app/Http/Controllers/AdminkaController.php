<?php

namespace App\Http\Controllers;
use App\Models\per;
use App\Models\Cats;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminkaController extends Controller
{
    public function Admin_Page()
    {
        $this_user = Auth::user();
    	return view('main.admin_page', ['user' => $this_user]);
    }

    public function Users_Page()
    {
        return view('main.users_page');
    }

    public function Users_Api()
    {
        $this_user_id = Auth::user()->id;
        $users = User::query() -> where('id', '!=', $this_user_id) -> get();
        return $users;
    }

    public function Delete_Post(Request $request)
    {
        $id = $request->id_post;
        per::destroy($id);

        return response()->json([
            'id'=>$id
          ]);
    }

    public function Delete_Cat(Request $request)
    {
        $id = $request->id_cat;
        Cats::destroy($id);

        return response()->json([
            'id'=>$id
          ]);
    }

    public function Add_Post(Request $request)
    {
        $post = new per;
        $post->name = $request->name;
        $post->sort_order = $request->sort_order;
        $post->text = $request->text;
        $post->desc  = $request->desc;
        $post->cats_id = $request->cats_id;
        $post->prop_one = $request->prop_one;
        $post->prop_two = $request->prop_two;
        // $post->created_at = null;
        // $post->updated_at = null;
            
        $post->save();
        
        return response()->json([
            'id'=>$post->id
          ]);
    }

    public function Add_Cat(Request $request)
    { 
        $name = mb_strtolower(trim($request->name));
        $flag = false;
        $vars = Cats::all();
        foreach ($vars as $cat_item) 
        {
            if($name == mb_strtolower($cat_item['name']))
            {
                $flag = true;
                break;
            }
        }

        if(!$flag)
        {
            $cat = new Cats;
            $cat->name = $request->name;    
            $cat->save();
        }

        return response()->json([
            'check'=>$flag
          ]);
    }

    public function Update_Post(Request $request)
    {
        $post = per::find($request -> id);
        $post -> name = trim($request -> name);
        $post -> desc = trim($request -> desc);
        $post -> cats_id = $request -> cats_id;
        $post->save();

        return response()->json([
            'post'=>$request->name
          ]);
    }

    public function Update_User(Request $request)
    {
        $user = User::find($request -> id);
        $role = $request -> role;
        if($role == true)
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        $user -> role = $status;
        $user->save();

        return response()->json([
            'result'=>$status
          ]);
    }

    public function Post_Api()
    {
        // $posts = per::all();
        //$posts = per::orderBy('id', 'desc')->get();
        $per_page = 2;

        $posts = per::query() -> orderBy('id', 'desc') -> paginate($per_page);

    	return $posts;
    }

    public function Cat_Api()
    {
        $cats = Cats::all();
    	return $cats;
    }
}
