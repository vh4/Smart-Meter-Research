<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actual;
use Illuminate\Support\Facades\Validator;
use App\Models\Lstm;

class ApiData extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(Request $request, $serialnumber)
    {
        #hapus data dengan serialnumber user terlebih dahulu sebelum dimasukan kedalam database
        Lstm::where('nomorserial_id', $serialnumber)->delete();

        date_default_timezone_set("Asia/Jakarta");


        foreach($request->json() as $x){


        $date = strtotime($x['tanggal']);

        $tanggal = date('Y-m-d H:i:s', $date);

        #lalu tambahkan lstm prediksi
        Lstm::create([
            'nomorserial_id' => $x['nomorserial_id'],
            'pemakaian_listrik' => $x['pemakaian_listrik'],
            'tanggal' => $tanggal
            ]);

        }



        return response()->json([
            'status' => 200,
            'success' => 'data sucessfully added !',
            ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($serialnumber)
    {
        $actual = Actual::where('nomorserial_id', $serialnumber)->get();
        if($actual == null){
            return response()->json([
                'status'=> 400,
                'gagal' => 'serial number is not found !'

                ]);
        }

        return response()->json($actual);
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
