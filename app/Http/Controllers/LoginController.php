<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login', [
            'title' => 'Form Login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|min:8|max:255',
            'password' => 'required|min:8|max:255'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        // dd('Berhasil Login'); 
        return back()->with('loginError', 'Login Failed!');
    }
}
