<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryToken;
class ApiToken extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('errors.404');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($serialnumber)
    {
        $token = Token::where('nomorserial_id', $serialnumber)->first();
        if($token == null){
            return response()->json([
                'status'=> 400,
                'gagal' => 'serial number is not found !'
                ]);
        }

        return response()->json($token);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $serialnumber)
    {

        $rules = [
            'trigger' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);

        }

        Token::where('nomorserial_id', (int) $serialnumber)->update([
            'trigger' => $request->trigger
        ]);

        return response()->json([
            'status' =>200,
            'success' => 'data successfully updated !',
            'token' => $request->trigger
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $serialnumber)
    {
        $rules = [
            'token' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);

        }

        Token::where('nomorserial_id', (int) $serialnumber)->update([
            'token' => $request->token
        ]);

        return response()->json([
            'status' =>200,
            'success' => 'data successfully updated !',
            'token' => $request->token
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function trigger(Request $request, $serialnumber)
    {
        $check_nomorserial = Token::where('nomorserial_id', (int) $serialnumber)->first();

        if($check_nomorserial == null){
            return response()->json([
                'status'=> 400,
                'gagal' => 'serial number is not found !'

                ]);
        }

        Token::where('nomorserial_id', $serialnumber)->update([
            'nomorserial_id' => (int) $request->json('nomorserial_id'),
            'trigger' => (int) $request->json('trigger')

            ]);


        return response()->json([
            'status' => 'trigger successfuly updated !',
            ]);
    }

    public function history(Request $request, $serialnumber){

        $check_nomorserial = Token::where('nomorserial_id', (int) $serialnumber)->first();

        if($check_nomorserial == null){

            return response()->json([
                'status'=> 400,
                'gagal' => 'serial number is not found !'
                ]);

        }
        HistoryToken::create([

            'nomorserial_id' => (int) $request->json('nomorserial_id'),
            'token' => $request->json('token'),
            'status' => $request->json('status'),

        ]);

        return response()->json([
            'status' => 'history successfuly added !',
            ]);
    }
}
