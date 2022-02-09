<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use Auth;
use File;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $url = url('').'/api/output';
        // $client = new \GuzzleHttp\Client();;
        // $request = $client->get($url);
        // $response = $request->getBody();

        // dd($response);
        $genap = Provider::whereRaw('(no_hp % 2) = 0')->get();
        $ganjil = Provider::whereRaw('(no_hp % 2) != 0')->get();
        return view('home', compact('genap', 'ganjil'));
    }

    public function input(){
        return view('input');
    }

    
}
