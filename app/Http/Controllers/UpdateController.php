<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;


class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'avatar' => 'required|image',
            'name' => 'required|string|max:255',
        ]);
    }


    public function updatename(Request $request)
    {
    $user = \Auth::user();
    $avatar=request()->file('avatar')->getClientOriginalName();
    request()->file('avatar')->storeAs('public/profiles', $avatar);


    $this->validator($request->all())->validate();

    $shops = Shop::all();
    $username = $request->name;
    session(['name' => $username]);
    $user->avatar = $avatar;
    $user->save();
    // $shop = Shop::find($id);
    // $shop->username = $request->name;
    // $shop->save();

    return view('profile', ['username' => $username, 'user' => $user, 'shops' => $shops]);
} 

    public function destroy() {
        $user = \Auth::user();
        $user->delete();
        return view('delete');
    }

}