<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
use App\Models\Actual;
use App\Models\User;
use App\Models\ARIMA;
use App\Models\LSTM;
use App\Models\Datalistrik;

use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     static function transformasi_jam($data){

        for($i=0;$i<count($data);$i++){
            $str = explode(" ",$data);
            $arr2 = explode(":",$str[1]);

            return $arr2;
        }
    }


    public function index()
    {
        //user untuk engineer
        $user = User::all();
        $total_rules_user = User::where('rules', 'user')->count();
        $total_verify = User::where('rules', 'user')->where('alat_terdaftar', 'selesai')->count();
        $total_not_verify = User::where('rules', 'user')->where('alat_terdaftar', 'belum')->count();

        //data listrik
        $data_listrik = Datalistrik::find(Auth::user()->user_id);
        //model arima, lstm and actual
        $actual = Actual::where('user_id', Auth::user()->user_id)->orderBy('tanggal', 'ASC')->get();
        $arima = ARIMA::where('user_id', Auth::user()->user_id)->orderBy('tanggal', 'ASC')->get();
        $lstm = LSTM::where('user_id', Auth::user()->user_id)->orderBy('tanggal', 'ASC')->get();

        //initial aactual
        $actual_tanggal = [];
        $actual_data = [];

        //initial arima
        $arima_tanggal = [];
        $arima_data = [];

        //initial lstm
        $lstm_tanggal = [];
        $lstm_data = [];

        //actual
        foreach($actual as $y){
            $str = explode(" ",$y->tanggal);
            $tanggal = explode("-", $str[0]);
            $jam = explode(":", $str[1]);
            $actual_tanggal[] = mktime($jam[0], $jam[1], $jam[2], $tanggal[1], $tanggal[2], $tanggal[0]) * 1000;
        }

        //arima
        foreach($arima as $x){
            $str1 = explode(" ",$x->tanggal);
            $tanggal1 = explode("-", $str1[0]);
            $jam1 = explode(":", $str1[1]);
            $arima_tanggal[] = mktime($jam1[0], $jam1[1], $jam1[2], $tanggal1[1], $tanggal1[2], $tanggal1[0]) * 1000;
        }

        //lstm
        foreach($lstm as $z){
            $str2 = explode(" ",$z->tanggal);
            $tanggal2 = explode("-", $str2[0]);
            $jam2 = explode(":", $str2[1]);
            $lstm_tanggal[] = mktime($jam2[0], $jam2[1], $jam2[2], $tanggal2[1], $tanggal2[2], $tanggal2[0]) * 1000;
        }

        //actual
        foreach ($actual as $x) {
            $actual_data[] =  $x->pemakaian_listrik;
        }
        //arima
        foreach ($arima as $k) {
            $arima_data[] =  $k->pemakaian_listrik;
        }
        //lstm
        foreach ($lstm as $j) {
            $lstm_data[] =  $j->pemakaian_listrik;
        }

        //final actual, arima and lstm
        $final_actual = [];
        $final_arima = [];
        $final_lstm = [];


        //actual
        for($i=0; $i< count($actual); $i++){

            $final_actual[] = [$actual_tanggal[$i], $actual_data[$i]];
        }

        //arima
        for($i=0; $i< count($arima); $i++){

            $final_arima[] = [$arima_tanggal[$i], $arima_data[$i]];
        }

         //lstm
         for($i=0; $i< count($lstm); $i++){

            $final_lstm[] = [$lstm_tanggal[$i], $lstm_data[$i]];
        }

        //export to json arima, lstm, and actual
        $final_actual = array(json_encode($final_actual));
        $final_arima = array(json_encode($final_arima));
        $final_lstm = array(json_encode($final_lstm));

        return view('dashboard', [
            'pengguna' => $user,
            'final_actual' => $final_actual,
            'final_arima' => $final_arima,
            'final_lstm' => $final_lstm,
            'data_listrik' => $data_listrik,
            'total_user' => $total_rules_user,
            'total_verify' => $total_verify,
            'total_not_verify' => $total_not_verify
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
        $id = Auth::user()->user_id;
        $validate = $request->validate([
            'token' => 'required|digits:20'
        ]);

        Token::where('user_id', $id)->update([
            'user_id' => $id,
            'token' => $validate['token']
        ]);
        return redirect('/dashboard')->with('success', 'token berhasil di kirim');
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
        if(Auth::user()->user_id == $id){

            $user = User::find($id);
            return view('profile', ['user' => $user]);

        }else{
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
        if(Auth::user()->user_id == $id){
            $validate = $request->validate([
                'username' => ['required', 'min:3', 'max:40'],
                'email' => 'required|email:dns',
                'alamat' => 'required|min:6|max:100',
                'nomer' => 'required|min:11|max:14',
                'password' => 'required|min:7|max:255',
                'gambar' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user_edit = User::find($id);
            $pws_check = $validate['password'] == Auth::user()->password ? true : false;

            if($pws_check == true){

                $user_edit->update($validate);

                if($request->hasFile('gambar')){

                    $request->file('gambar')->move(public_path('img'), $request->file('gambar')->getClientOriginalName());
                    $user_edit->gambar = $request->file('gambar')->getClientOriginalName();
                    $user_edit->save();
                }
                return redirect('/dashboard/profile/' .$id)->with('success', 'data berhasil di update');
            }else{
                $validate['password'] = bcrypt($validate['password']);
                $user_edit->update($validate);

                if($request->hasFile('gambar')){

                    $request->file('gambar')->move(public_path('img'), $request->file('gambar')->getClientOriginalName());
                    $user_edit->gambar = $request->file('gambar')->getClientOriginalName();
                    $user_edit->save();
                }
                return redirect('/dashboard/profile/' .$id)->with('success', 'data berhasil di update');
            }
        }else{
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
        $user = User::find($id);
        $user->delete($user);

        return redirect('/dashboard')->with('delete', 'data berhasil di hapus');

    }
}
