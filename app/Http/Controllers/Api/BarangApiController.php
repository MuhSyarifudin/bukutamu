<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BarangApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($acara_id)
    {
        //mendapatkan data barang
        return DataTables::of(Barang::where('acara_id',$acara_id)->get())
        ->addIndexColumn()
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
        //menambah data barang
        $validate = $request->validate([
            'nama'=>'required|max:30',
            'barang'=>'required',
            'alamat'=>'required',
        ],[
            'nama.required'=>'Nama pengunjung tidak boleh kosong!',
            'nama.max'=>'Nama pengunjung maksimal 30 karakter!',
            'barang.required'=>'Masukan nama barang yang dibawa!',
            'alamat'=>'Alamat pengunjung tidak boleh kosong!'
        ]);

        $nama = $request->nama;
        $barang = $request->barang;
        $alamat = $request->alamat;
        $catatan = $request->catatan;
        $acara_id = $request->acara_id;

        $user = User::where('id',Auth::user()->id)->first();

        if ($acara_id!=0) {
            Barang::create([
                'nama_pengunjung'=>$nama,
                'nama_barang'=>$barang,
                'alamat'=>$alamat,
                'catatan'=>$catatan,
                'user_id'=>$user->id,
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
        //menampilkan data barang sesuai id
         $pengunjung = Barang::findOrFail($id);
         return response()->json($pengunjung);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //mengubah data barang

        $validate = $request->validate([
            'nama'=>'required|max:30',
            'barang'=>'required',
            'alamat'=>'required',
        ],[
            'nama.required'=>'Nama pengunjung tidak boleh kosong!',
            'nama.max'=>'Nama pengunjung maksimal 30 karakter!',
            'nama_barang'=>'Masukan nama barang yang dibawa!',
            'alamat'=>'Alamat pengunjung tidak boleh kosong!'
        ]);

        $user = User::where('id',Auth::user()->id)->first();

        $id = $request->id;
        $nama = $request->nama;
        $barang = $request->barang;
        $alamat = $request->alamat;
        $catatan = $request->catatan;
        $acara_id = $request->acara_id;

        Barang::where('id',$id)->update([
            'nama_pengunjung'=>$nama,
            'nama_barang'=>$barang,
            'alamat'=>$alamat,
            'catatan'=>$catatan,
            'acara_id'=>$acara_id,
            'user_id'=>$user->id
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data barang sesuai id
        $barang = Barang::find($id);

        if($barang){
            $nama = $barang->nama_pengunjung;
            $barang->delete();
            return response()->json(['success'=>true,'nama'=>$nama]);
        }

        return response()->json(['success'=>false,'message'=>'Data tidak ditemukan!'],404);
    }
}
