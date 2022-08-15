<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegistrerEngineer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.register',[
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
                    return redirect('/dashboard/register')->with('error', 'rules admin / engineer is required !');
                }

                $validate = $request->validate([
                    'username' => ['required', 'min:5', 'unique:users'],
                    'email' => 'required|unique:users|',
                    'nomer' => 'numeric|required|min:11',
                    'password' => 'required|min:7',
                ]);

                $validate['password'] = bcrypt($validate['password']);
                $validate['gambar'] = 'user.png';
                $validate['rules'] = $request->rules;

        /*
            created user
       */

                User::create([
                    'username' => $validate['username'],
                    'email' => $validate['email'],
                    'nomer' => $validate['nomer'],
                    'password' => $validate['password'],
                    'gambar' => $validate['gambar'],
                    'rules' => $validate['rules']
                ]);

                notify()->success('Registration account successfully!', 'Success');
                return redirect('/dashboard');

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

    /*

        Delete User (pada dashboard Admin)

    */

            $user = User::find($id);
            $user->delete($user);

            notify()->error('Account has been deleted successfully !', 'Deleted');
            return redirect('/dashboard');
    }
}
