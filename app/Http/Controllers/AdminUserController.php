<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'title' => 'All Kasir',
            'users' => User::where('is_admin', 0)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'title' => 'Form Data Kasir'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|min:5',
                'username' => 'required|min:5|alpha_num|unique:users',
                'password' => 'required|min:5|alpha_num'
            ]
        );

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/admin/users')->with('success', 'Data Kasir Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'title' => 'Form Data Kasir',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'nama' => 'required|min:5',
            'password' => 'required|min:5|max:255'
        ];
        //cek apakah ada username baru?
        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:5|max:255|unique:users';
        }
        // cek validasi
        $validatedData = $request->validate($rules);
        // cek jika password baru tidak sama password lama
        if (!Hash::check($request['password'], auth()->user()->password)) {
        }
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::where('id', $user->id)
            ->update($validatedData);
        return redirect('/admin/users')->with('success', 'Data Kasir Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/admin/users')->with('success', 'Data Kasir Berhasil Dihapus');
    }
}
