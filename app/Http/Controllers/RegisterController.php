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

    public function daftar(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|min:8',
                'username' => 'required|min:8|max:255|unique:users',
                'password' => 'required|min:8|max:255'
            ]
        );

        // dd('Berhasil Register');
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        // $request->session()->flash('success', 'Registration Succeccfull! Please Login');
        return redirect('/login')->with('success', 'Registration Successfull! Please Login');
    }
}
