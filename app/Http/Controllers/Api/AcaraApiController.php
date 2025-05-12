<?php

namespace App\Http\Controllers\Api;

use App\Models\Acara;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;

class AcaraApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mendapatkan data acara
        // dd(Auth::user()->id);
        $user = User::where('id',Auth::user()->id)->first();
       return DataTables::of(Acara::where('user_id',$user->id)->get())
        ->addIndexColumn()
        ->editColumn('tanggal',function($row){
            $date_convert = strtotime($row->tanggal);
            return dateid('l,j F Y',$date_convert);
        })->make(true);
        
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
        //menyimpan data acara
        $validated = $request->validate([
            'nama'=>'required|max:30',
            'tanggal'=>'required'
        ],[
            'nama.required'=>'Nama acara tidak boleh kosong!',
            'nama.max'=>'Nama acara maksimal 30 karakter!',
            'tanggal'=>'Tanggal acara wajib diisi!'
        ]);

        $nama = $request->nama;
        $date_string = strtotime($request->tanggal);
        $tanggal = date('Y-m-d',$date_string);

        Acara::create([
            'nama'=>$nama,
            'user_id'=>Auth::user()->id,
            'tanggal'=>$tanggal
        ]);

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
        //menampilkan data berdasarkan id
        $acara = Acara::where('id',$id)->first();
        return response()->json($acara);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //mengubah data acara dengan id
        $id = $request->id;
        $nama = $request->nama;

        $date_string = strtotime($request->tanggal);
        $tanggal = date('Y-m-d',$date_string);

        $tanggalisnull = Acara::find($id);

        if ($request->tanggal) {
            $date = DateTime::createFromFormat('d/m/Y', $request->tanggal);
            if ($date) {
                $tanggal = $date->format('Y-m-d');
            } else {
                $tanggal = $tanggalisnull->tanggal;
            }
        } else {
            $tanggal = $tanggalisnull->tanggal;
        }

        Acara::find($id)->update([
            'nama' => $nama,
            'tanggal' => $tanggal
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data acara sesuai id
        $acara = Acara::find($id);

        if ($acara) {
            $nama = $acara->nama;
            $acara->delete();
            return response()->json(['success'=> true, 'nama'=> $nama]);
        }

        return response()->json(['success'=>false,'message'=>'Data tidak ditemukan!']);
    }
}
