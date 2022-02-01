<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use App\Models\User;

class Register extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules = ['admin', 'user', 'engineer'];
       if(!in_array($request->rules, $rules)){
           return redirect('/dashboard/register/user')->with('error', 'rules harus di isi');
       }
       $validate = $request->validate([
           'username' => ['required', 'min:3', 'max:40', 'unique:users'],
           'email' => 'required|email:dns|unique:users',
           'alamat' => 'required|min:6|max:100',
           'nomer' => 'required|min:11|max:14',
           'password' => 'required|min:7|max:255',
       ]);

       $validate['password'] = bcrypt($validate['password']);
       $validate['gambar'] = 'user.png';
       $validate['alat_terdaftar'] = 'belum';
       $validate['rules'] = $request->rules;

       User::create($validate);

       return redirect('/dashboard')->with('success', 'Registration successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
