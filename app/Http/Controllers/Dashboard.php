<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Token;
use App\Models\Actual;
use App\Models\User;
use App\Models\Datalistrik;
use App\Models\Alat;
use App\Models\Nomorserial;
use Illuminate\Support\Facades\Auth;
use App\Models\Lstm;
use App\Models\Historytoken;

class Dashboard extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        /*

            mengambil semua data alats yang telah didaftarkan oleh engineer dengan user_id sesuai dengan pengguna login. lalu akan ditampilkan di dashboard engineer

        */
                $daftar_data_alats_engginer = Alat::where('engineer_id', Auth::user()->user_id)->get();


        /*

            Mengambil Serial Number pada table Nomorserial yang telah didaftarkan /dibuat oleh enggineer, tujuanya => untuk check ketika pengguna
            salah saat registrasi user pada form input serial number dan untuk relasi antara table user, token, lstm, actual dan datalistrik

        */

                $userserialnumber = Nomorserial::where('user_id', Auth::user()->user_id)->first();
                $serialnumber = null;

                if($userserialnumber == null){
                    $serialnumber = null;
                }else{
                    $serialnumber = $userserialnumber->nomorserial_id;
                }
                
        /*

            Mengambil Token Hisotory pada pengguna dan akan ditampilkan di dashboard user.

        */

                $tokenHistory = Historytoken::where('nomorserial_id', $serialnumber)->orderBy('tanggal', 'DESC')->get();

        /*

                total alat (serial number) => menghitung jumlah alat yang sudah jadi, dan sudah diregistrasi oleh pengguna. dan juga yang belum di registrasi
                lalu akan ditampilkan kedalam dashboard admin
        */
                $total_alat = Alat::all()->count();
                $total_alat_yang_jadi_tapi_sudah_ada_user = User::where('rules', 'user')->get()->count();
                $total_alat_yang_jadi_tapi_belum_ada_user = $total_alat -  $total_alat_yang_jadi_tapi_sudah_ada_user;


        /*

            panggil semua data User yang ada di database dan panggil dimana dengan kondisi rules sudah terdaftar atau belum,
            dengan menggunakan Query Builder (dengan Model MVC) dengan bantual all(), where() dan lainya.
            lalu selanjutnya datanya akan ditampilkan didashboard admin

        */

                $user = User::all();


        /*

            return view dashboard dengan membawa data-data yang telah di panggil

        */
        
            
                 return view('dashboard', [
                    'title' => 'Home',
                    'subtitle' => 'Dashboard',
                    'pengguna' => $user,
                    'total_alat_jadi_yang_sudah_ada_user' => $total_alat_yang_jadi_tapi_sudah_ada_user,
                    'total_alat_jadi_yang_belum_ada_user' => $total_alat_yang_jadi_tapi_belum_ada_user,
                    'total_alat_jadi' => $total_alat,
                    'data_alats_engginer_daftarkan' => $daftar_data_alats_engginer,
                    'tokenHistory' => $tokenHistory,
                    'serialnumber' => $serialnumber,
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

            mengupdate Token dimana user id merupakan pengguna website yang login

        */

                $user = User::find(Auth::user()->user_id);
                $validate = $request->validate([
                    'token' => 'required|digits:20'
                ]);

                Token::where('nomorserial_id', $user->nomorserial->nomorserial_id)->update([
                    'nomorserial_id' => $user->nomorserial->nomorserial_id,
                    'token' => $validate['token'],
                    'trigger' => 1,
                ]);

        /*

            redirect ke dashboard jika sudah di update

        */
                notify()->info('Waiting Token until submitted successfully ! Click icon check for updated', 'Waiting');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*

            mengupdate Token dimana user id merupakan pengguna website yang login

        */

                if(Auth::user()->user_id == $id){
                    $user = User::find($id);
                    return view('profile', [
                        'user' => $user,
                        'title' => 'Profile',
                        'subtitle' => 'Edit Profile',
                ]);
                }
                else
                {
                    return redirect('/');
                }
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
        /*

            Validasi untuk form user,engineer dan admin update profile

        */
            if(Auth::user()->user_id == $id){
                $validate = $request->validate([
                    'username' => ['required', 'min:3', 'max:40'],
                    'email' => 'required',
                    'nomer' => 'required|min:11',
                    'password' => 'required|min:7',
                    'gambar' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            ]);

        /*

            check password apakah password yang diinputkan benar atau tidak

        */
                $user_edit = User::find($id);
                $pws_check = $validate['password'] == Auth::user()->password ? true : false;

        /*

            check password apakah password yang diinputkan benar atau tidak, jika benar maka :
            diupdate semua datanya dan diupdate juga nama gambar yang ada didatabase
            selanjutnya file gambar akan diupload didalam folder

            "pasword tidak akan diganti karena tidak ada perubahan : input oleh pengguna dan didatabase sama , jadi otomatis tidak ada perubahan!"

        */
                if($pws_check == true){
                    $user_edit->update($validate);
                        if($request->hasFile('gambar')){
                            $request->file('gambar')->move(public_path('img'), $request->file('gambar')->getClientOriginalName());
                            $user_edit->gambar = $request->file('gambar')->getClientOriginalName();
                             $user_edit->save();
                            }
                    notify()->success('profile successfully updated !');
                    return redirect('/dashboard/profile/' .$id);
                }

        /*

            check password apakah password yang diinputkan benar atau tidak, jika tidak:
            jika password tidak sama yang ada didatabase, maka password akan
            diganti dengan password baru dan jika gambar diupdate
            maka gambar akan otomatis juga diupdate

        */
                else
                {
                    $validate['password'] = bcrypt($validate['password']);
                    $user_edit->update($validate);

                        if($request->hasFile('gambar'))
                        {

                            $request->file('gambar')->move(public_path('img'), $request->file('gambar')->getClientOriginalName());
                            $user_edit->gambar = $request->file('gambar')->getClientOriginalName();
                            $user_edit->save();
                        }
                    notify()->success('profile successfully updated !');
                    return redirect('/dashboard/profile/' .$id);
                }
            }
            else
            {
                return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

    }

    public function reset($serialnumber){

        Token::where('nomorserial_id', $serialnumber)->update([
            'trigger' => 0,
        ]);

        return redirect('/dashboard');

    }
}
