<?php

namespace App\Http\Controllers;
use App\Models\per;
use Illuminate\Http\Request;
use App\Models\Cats;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MainController extends Controller
{
    public function Main_Page()
    {
        $this_user = Auth::user();
    	return view('main.main_page', ['user' => $this_user]);
    }

    public function Post_Page(Request $request)
    {
    	return view('main.post_page', ['req' => $request]);
    }

    public function Post_Detail($cat,$name)
    {	
        $vars = Cats::all();

        foreach ($vars as $cat_item) 
        {
            if($cat == str_slug($cat_item['name']))
            {
                foreach ($cat_item->posts as $post_item) 
                {
                    if($name == str_slug($post_item['name']))
                    {
                      return view('main.post_detail', ['post' => $post_item]);  
                    }
                }
            }
        }

        return abort(404);
    }

    public function Post_Cat(Request $request, $cat)
    {
        $vars = Cats::all();
        foreach ($vars as $item) 
        {
            if($cat == str_slug($item['name']))
            {
                return view('main.post_cat', [
                    'cat_name' => $item['name'],
                    'cat_id' => $item['id'],
                    'req' => $request
                ]);
            }
        }

        return abort(404);
    }

    public function Send_Mail(Request $request) 
    {
        require_once base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);

        $mail->CharSet = "UTF-8";
        $mail->From     = 'cq44491@vh440.timeweb.ru';
        $mail->AddAddress('testgubin@mail.ru');
        $mail->IsHTML(true);
        $mail->Subject  =  "Тема письма";
        $mail->Body     =  "Тело письма";
        $result = 'no';
        // if ($mail->send())
        // {
        //     $result = 'yes';
        // }

        $result = 'yes';

        return response()->json([
            'success'=>$result
        ]);
    }

    public function Registration(Request $request)
    {
        $login = trim($request->login);
        $password = trim($request->password);

        $users = User::all();
        $flag = true;
        foreach ($users as $item) 
        {
            if($item['login'] == $login)
            {
                $flag = false;
                break;
            }
        }

        if($flag)
        {
            $user = new User;
            $user->login = $login;
            $user->password = $password;
            $user->role = 0;
            $user->save();
            Auth::login($user);
        }
        
        return response()->json([
            'chek_user'=>$flag
          ]);
    }

    public function Registration_Page()
    {
        if(Auth::id() != null)
        {
            return redirect('/adminka');
        }
        else
        {
            return view('main.reg_page');
        }
    }

    public function Go_Out()
    {
        Auth::logout();

        return response()->json([
            'success'=>'yes',
          ]);
    }

    public function Auth_Page()
    {
        if(Auth::check())
        {
            return redirect('/adminka');
        }
        else
        {
            return view('main.auth_page');
        }
    }

    public function Auth_Form(Request $request)
    {
        $formFields = [
            'login' => trim($request->login),
            'password' => trim($request->password)
        ];

        $flag = false;

        if(Auth::attempt($formFields))
        {
            $flag = true;
        }
        
        return response()->json([
            'chek_user'=>$flag
          ]);
    }
}
