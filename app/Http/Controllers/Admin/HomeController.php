<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // controllo se utente é loggato
        // dd(Auth::user()->get());
        if (Auth::check() && Auth::user()->roles()->get()->first()->name === 'admin') {
            return view('admin.home');
        }
        else {
            return view('guest.home');
        // abort('403');
        }
    }
}
