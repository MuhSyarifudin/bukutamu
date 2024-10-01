<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengunjung = Pengunjung::where('id','0')->get();
        $acara_id = null;
        $acara = Acara::all();

        return view('pengunjung.index',['title'=>'Pengunjung','pengunjung'=>$pengunjung,'acara'=>$acara,'acara_id'=>$acara_id]);
    }

    public function index2(Request $request){

        $acara_id = $request->_acara;

        $pengunjung = Pengunjung::where('acara_id',$acara_id)->get();
        $acara = Acara::all();

        return view('pengunjung.index',['title'=>'Pengunjung','pengunjung'=>$pengunjung,'acara'=>$acara,'acara_id'=>$acara_id]);
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
        $request->validate([
            'nama' => ['required','max:30'],
            'alamat' => ['required','max:70'],
            'uang' => ['required','max:10'],
            'status' => ['required'],
            'acara_id'=>['required']
        ],[
            'acara_id.required'=>['Tolong pilih acara terlebih dahulu']
        ]);

        $nama = $request->nama;
        $alamat = $request->alamat;
        $notelp = $request->notelp;
        $uang = $request->uang;
        $status = $request->status;
        $acara_id = $request->acara_id;

        Pengunjung::create([
            'nama'=>$nama,
            'alamat'=>$alamat,
            'no_telp'=>$notelp,
            'uang'=>$uang,
            'status'=>$status,
            'acara_id'=>$acara_id
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
    public function update(Request $request,$id)
    {
        $nama = $request->nama;
        $alamat = $request->alamat;
        $notelp = $request->notelp;
        $uang = $request->uang;
        $status = $request->status;

        Pengunjung::where('id',$id)->update([
            'nama'=>$nama,
            'alamat'=>$alamat,
            'no_telp'=>$notelp,
            'uang'=>$uang,
            'status'=>$status
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pengunjung::where('id',$id)->delete();

        return back();
    }

   
}
