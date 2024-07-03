<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UserDepartment;
use Auth;

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
        session(['role_user' => UserDepartment::roleUser(Auth::user()->id,1,1)]);
        Log::channel('dblog')->info('This is a test log message.');
        return view('home');
    }

    public function test()
    {
        return view('test');
    }
}
