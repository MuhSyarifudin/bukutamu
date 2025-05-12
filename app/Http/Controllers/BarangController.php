<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $token;
    public $acara_id;


    public function index()
    {
        $acara_id = null;
        $acara = Acara::where('user_id',Auth::user()->id)->get();

        //redirect ke halaman barang
        return view('barang.index',['title'=>'Barang','active_menu'=>'barang','acara'=>$acara,'acara_id'=>$acara_id,'token'=>session('token')]);
    }

    public function index2(Request $request){
        $acara_id = $request->_acara;
        $acara = Acara::where('user_id',Auth::user()->id)->get();
        return view('barang.index',['title'=>'Barang','active_menu'=>'barang','acara'=>$acara,'acara_id'=>$acara_id,'token'=>session('token')]);
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
