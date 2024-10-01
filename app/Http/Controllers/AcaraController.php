<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use App\Models\Acara;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acara = Acara::all();

        return view('acara.index',['title'=>'Acara','acara'=>$acara]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nama_acara = $request->nama;
        $tanggal_acara = $request->tanggal;

        $date_convert = strtotime($tanggal_acara);

        $converted_date = date('Y-m-d',$date_convert);

        Acara::create([
            'nama'=>$nama_acara,
            'tanggal'=>$converted_date
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $nama_acara = $request->nama;
        $tanggal_acara = $request->tanggal;

        $date_convert = strtotime($tanggal_acara);

        $converted_date = date('Y-m-d',$date_convert);


        Acara::where('id',$id)->update([
            'nama'=>$nama_acara,
            'tanggal'=>$converted_date
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Acara::where('id',$id)->delete();

        return back();
    }

   
}
