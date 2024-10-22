<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Pengunjung;

class PengunjungApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($acara_id)
    {
        //mendapatkan data pengunjung
        return DataTables::of(Pengunjung::select('*','uang AS uang2')->where('acara_id',$acara_id)->get())
        ->addIndexColumn()
        ->editColumn('uang', function($row) {
            return rupiah($row->uang);  // menggunakan format rupiah dari helpers
        })
        ->make(true);
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

        //melakukan validasi
        $validated = $request->validate([
            'nama'=>'required|max:30',
            'alamat'=>'required',
            'uang'=>'required',
            'status'=>'required'
        ],['nama.required'=>'Nama pengunjung tidak boleh kosong!',
           'nama.max'=>'Nama pengunjung maksimal 30 karakter!',
           'alamat.required'=>'Alamat pengunjung tidak boleh kosong!',
           'uang.required'=>'Nominal uang tidak boleh kosong!',
        ]);

        //menyimpan data pengunjung
        $nama = $request->nama;
        $alamat = $request->alamat;
        $notelp = $request->notelp;
        $uang = $request->uang;
        $status = $request->status;
        $acara_id = $request->acara_id;

        if($acara_id!=0){
            Pengunjung::create([
                'nama'=>$nama,
                'alamat'=>$alamat,
                'no_telp'=>$notelp,
                'uang'=>$uang,
                'status'=>$status,
                'acara_id'=>$acara_id
            ]);
        }
        
        
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
        //menampilkan data pengunjung sesuai id
        $pengunjung = Pengunjung::findOrFail($id);
        return response()->json($pengunjung);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //mengubah data pengunjung
        $id = $request->id;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $notelp = $request->notelp;
        $uang = $request->uang;
        $status = $request->status;
        $acara_id = $request->acara_id;

        Pengunjung::where('id',$id)->update([
            'nama'=>$nama,
            'alamat'=>$alamat,
            'no_telp'=>$notelp,
            'uang'=>$uang,
            'status'=>$status,
            'acara_id'=>$acara_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data pengunjung sesuai id
        $pengunjung = Pengunjung::find($id);

        if($pengunjung){
            $nama = $pengunjung->nama;
            $pengunjung->delete();
            return response()->json(['success'=>true,'nama'=>$nama]);
        }

        return response()->json(['success'=>false,'message'=>'Data tidak ditemukan!'],404);
    }
}
