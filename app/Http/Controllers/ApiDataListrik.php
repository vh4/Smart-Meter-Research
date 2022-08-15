<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datalistrik;
use App\Models\Actual;

class ApiDataListrik extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $serialnumber)
    {
        $check_nomorserial = Actual::where('nomorserial_id', $serialnumber)->get();
        if($check_nomorserial == null){
            return response()->json([
                'status'=> 400,
                'gagal' => 'serial number is not found !'

                ]);
        }

        Actual::create([
            'nomorserial_id' => $request->json('nomorserial_id'),
            'pemakaian_listrik' => (float) $request->json('pemakaian_listrik')
            ]);


        return response()->json([
            'status' => 'data successfully added !'
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
        $check_nomorserial = Datalistrik::where('nomorserial_id', $serialnumber)->get();

        if($check_nomorserial == null){
            return response()->json([
                'status'=> 400,
                'gagal' => 'serial number is not found !'

                ]);
        }

        Datalistrik::where('nomorserial_id', $serialnumber)->update([
            'nomorserial_id' => $request->json('nomorserial_id'),
            'sisa_pulsa' => (float) $request->json('sisa_pulsa')

            ]);


        return response()->json([
            'status' => 'data sucessfully updated !'
            ]);
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
