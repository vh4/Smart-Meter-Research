<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
use App\Models\Token;
use App\Models\Datalistrik;
use App\Models\Nomorserial;
use App\Models\Alat;
use App\Models\Email;

class Register extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register',[
            'title' => 'Register',
            'subtitle' => 'Form Register',
        ]);

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

         /*

            check rules yang didaftarkan haruslah admin, user dan engineer saja

         */

                $rules = ['admin', 'user', 'engineer'];
                    if(!in_array($request->rules, $rules)){
                        return redirect('/register')->with('error', 'rules is required !');
                    }

       /*
            created user
       */

                $validate = $request->validate([
                    'username' => ['required', 'min:5', 'unique:users'],
                    'email' => 'required|unique:users|',
                    'nomorserial' => ['required', 'min:10', 'max:50'],
                    'nomer' => 'required|min:11',
                    'password' => 'required|min:7',
                ]);

        /*

        check serial number apakah ada, jika ada serial number maka registrasi pengguna akan disimpan kedalam database

        */

                $alat = Alat::all();
                $nomorserial_table = Nomorserial::all();
                $serialnumberList = [];
                $serialnumberList_exist_use = [];

                foreach($nomorserial_table as $x){
                    $serialnumberList_exist_use[] = $x->nomorserial_id;
                }

                foreach($alat as $x){
                    $serialnumberList[] = $x->nomorserial;
                }


                if(!in_array($validate['nomorserial'], $serialnumberList)){
                    return redirect('/register')->with('nomorserial_tidakterdaftar', 'Serial number is not registered !');
                }

                if(in_array($validate['nomorserial'], $serialnumberList_exist_use)){
                    return redirect('/register')->with('nomorserial_tidakterdaftar', 'Serial number is already used !');
                }

                $validate['password'] = bcrypt($validate['password']);
                $validate['gambar'] = 'user.png';
                $validate['rules'] = $request->rules;

                User::create([
                    'username' => $validate['username'],
                    'email' => $validate['email'],
                    'nomer' => $validate['nomer'],
                    'password' => $validate['password'],
                    'gambar' => $validate['gambar'],
                    'rules' => $validate['rules']
                ]);

       /*

            panggil dan temukan user yang sudah terdaftar tadi untuk ambil user_id

       */
                $user = User::where('email', $validate['email'])->first();
                Nomorserial::create([
                    'user_id' => $user->user_id,
                    'nomorserial_id' => (string) $validate['nomorserial'],
                ]);



       /*

            hanya user yang perlu didaftarkan alat pada table data listrik dan data token

       */

                if($user->rules == 'user'){

                /*

                    daftarkan user baru pada table SerialNumber

                */



                    /* daftarkan user baru pada table datalistrik */

                    Datalistrik::create([
                        'nomorserial_id' => (string) $validate['nomorserial'],
                        'sisa_pulsa' => null,
                        'sisa_pulsa_n-1' => null,
                    ]);

                /*

                    daftarkan user baru pada table Token

                */

                        Token::create([

                            'nomorserial_id' => (string) $validate['nomorserial'],
                            'token' => null,
                            'trigger' => null,
                        ]);

                /*

                    daftarkan user baru pada table Email

                */

                Email::create([
                    'nomorserial_id' => (string) $validate['nomorserial'],
                    'subject' => null,
                ]);

                }


    /*
        jika selesai, kembali ke dashboard

    */

                notify()->success('Registration successfully !');
                return redirect('/');
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
