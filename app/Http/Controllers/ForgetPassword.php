<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Forget;
use App\Models\Token;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPassword extends Controller
{
    public function index(){

        /*
               index lupa password ke tampilan view
        */

                return view('lupaPassword',[
                    'title' => 'Password',
                    'subtitle' => 'Form Forget Password',
                ]);
    }

    public function forgot(Request $request){

        /*

            panggil user  dimana email == email input

        */

                $user = User::where('email', $request->email)->first();
        /*

            cek ada ato tidak emailnya

        */

                if($user  == null)
                {
                    notify()->error('Email is not registered !', 'Error');
                    return redirect('/forgot');
                }

        /*

            create token

        */

                Forget::create([
                    'user_id' => $user->user_id,
                    'token' => Str::random(32),
                ]);

        /*

            panggil token dimana user_id pengguna = user_id

        */

                $user_token = Forget::where('user_id', $user->user_id)->first();

        /*

            kirim via email lupa password

        */

                $this->sendForgetPassword($user, $user_token->token);
                    notify()->info('Code activation has been sent to your email !', 'Activation');
                    return redirect('/forgot')->with('status', '');

    }

    public function sendForgetPassword($user, $user_token){

        /*

            email via dengan data user dan token

        */

                Mail::send('email.forgetPassword',[
                    'user' => $user,
                    'token' => $user_token
                ],

        /*

            kirim ke email yang dituju dan dengan subject

        */

                function($message) use ($user){
                    $message->to($user->email);
                        $message->subject("Hello $user->username, Link Aktivasi Forget Password kamu", "Activation for Forget Password");
                }
        );
  }

    public function reset($email, $token){

        /*

            Mengambil Semua data dimana email = email pengguna

        */

                $user = User::where('email', $email)->first();

        /*

            cek ada ato tidak emailnya

        */

                if($user  == null){
                    notify()->error('Email is not registered !', 'Error');
                    return redirect('/forgot');
                }

        /*

            cek apakah token sama yang ada didatabase

        */

                $token_checked = Forget::where('token', $token)->first();
                if($token_checked  == null){
                    notify()->error('Token has been expired !', 'Expired');
                    return redirect('/forgot');
                }
        /*

            return ke tampilan view reset password

        */

            return view('resetPassword', ['token' => $token_checked->token, 'user' => $user,
                'title' => 'Password',
                'subtitle' => 'Form New Password',
        ]);
    }

    public function new_password(Request $request, $email, $token){

        /*

            validasi password

        */

                $validate = $request->validate([
                    'password' => 'required|min:7|max:255',
                ]);

        /*

            enkripsi password

        */

                $validate['password'] = bcrypt($validate['password']);

        /*

            ganti password

        */

                User::where('email', $email)->update([
                    'password' => $validate['password']
                ]);

        /*

            expired token untuk dihapus !

        */

                Forget::where('user_id', $request->user_id)->delete();

                notify()->success('password successfully changed !', 'Success');
                return redirect('/');
    }
}
