<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.register', [
            'title' => 'Form Register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|min:6',
                'username' => 'required|min:6|max:255|unique:users',
                'password' => 'required|min:6|max:255'
            ]
        );

        // dd('Berhasil Register');
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        // $request->session()->flash('success', 'Registration Succeccfull! Please Login');
        return redirect('/login')->with('success', 'Registration Berhasil! Silahkan Login');
    }
}
