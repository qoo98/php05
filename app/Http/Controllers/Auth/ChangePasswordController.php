<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'new_password' => 'required|string|min:6',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }
   
    public function edit()
    {
      return view('change')
              ->with('user', \Auth::user());
    }
   
    public function update(Request $request)
    {
    // ID のチェック
    //（ここでエラーになることは通常では考えられない）
    if ($request->id != \Auth::user()->id) {
        return redirect('/home')
                ->with('warning', '致命的なエラーです');
      }
      $user = \Auth::user();
      // 現在のパスワードを確認
      if (!password_verify($request->current_password, $user->password)) {
        return redirect('/password/change')
                ->with('warning', 'パスワードが違います');
      }
      // Validation（6文字以上あるか，2つが一致しているかなどのチェック）
      $this->validator($request->all())->validate();
      // パスワードを保存
      $user->password = bcrypt($request->new_password);
      $user->email = $request->email;
      $user->save();
      return redirect('/shops');
    }  
  }

