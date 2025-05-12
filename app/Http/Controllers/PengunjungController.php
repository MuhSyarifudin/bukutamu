<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // protected $token;
    public $acara_id;

    public function index()
    {
        $acara_id = null;

        $acara = Acara::where('user_id',Auth::user()->id)->get();

        return view('pengunjung.index',['title'=>'Pengunjung','acara'=>$acara,'acara_id'=>$acara_id,'active_menu'=>'pengunjung']);
    }

    public function index2(Request $request){

        $this->acara_id = $request->_acara;

        $acara = Acara::where('user_id',Auth::user()->id)->get();
        
        return view('pengunjung.index',['title'=>'Pengunjung','acara'=>$acara,'acara_id'=>$this->acara_id,'active_menu'=>'pengunjung']);
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
    public function update(Request $request,$id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    
   
}
