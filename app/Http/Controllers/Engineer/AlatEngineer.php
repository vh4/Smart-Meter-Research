<?php

namespace App\Http\Controllers\Engineer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alat;

class AlatEngineer extends Controller
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



    //make create a serial number using the number date month year user id
    $serial = date('Ymd').$request->user_id;
    $serial = strtoupper($serial);

    //fetch and count database Alat
    $alat = Alat::count();

    $alat = $alat + 1;

    //make a serial number with the number of user
    $serial = $serial. "-" . $alat;
    $serial = strtoupper($serial);
    $serial = substr($serial, 0, 10);

    Alat::create([
        'engineer_id' => $request->engineer_id,
        'nomorserial' => $serial,
    ]);

    return redirect('/dashboard')->with('success', $serial);

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
        $delete = Alat::find($id)->delete();
        notify()->error('Serial number sucessfully deleted !', 'Deleted');
        return redirect('/dashboard');
    }
}
