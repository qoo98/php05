<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Lists;
use Illuminate\Http\Request;
use App\User;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')-> except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();

        return view('index', ['shops' => $shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shops = Shop::all();
        $shop = new Shop;
        $user = \Auth::user();

        $shop->name = request('name');
        $shop->address = request('address');
        $shop->message = request('message');
        $shop->user_id = $user->id;

        $count = Lists::count();
        $shop->lists_id = $count + 1;
        
        
        foreach ($shops as $s) {
            if($s->address == $shop->address) {
                $shop->lists_id = $s->lists_id;
            } 
        }
        
        if($count + 1 == $shop->lists_id) {
            $lists = new Lists;
            $lists->data = $shop->lists_id;
            $lists->save();
        }
        

        $parts = explode("@", $user->email);
        $shop->username = $parts[0];
        if (session()->has('name')) {
            $shop->username = session('name');
        }
        $shop->save();
        return redirect()->route('shop.list', ['lists_id' => $shop->lists_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show($lists_id)
    {
        $shop = Shop::find($lists_id);
        $shops = Shop::all();

        return view('show', ['shop' => $shop, 'shops' => $shops]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */


    public function profile()
    {
        $shops = Shop::all();
        $user = \Auth::user();
        $parts = explode("@", $user->email);
        $username = $parts[0];
        if (session()->has('name')) {
            $username = session('name');
        }
        
        return view('profile', ['username' => $username, 'user' => $user, 'shops' => $shops]);
    }

    public function change()
    {
        return view('change');
    }
}
