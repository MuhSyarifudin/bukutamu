<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $acara_id;

    public function index()
    {
        $acara_id = null;
        $acara = Acara::all();

        return view('pengunjung.index',['title'=>'Pengunjung','acara'=>$acara,'acara_id'=>$acara_id]);
    }

    public function index2(Request $request){

            $this->acara_id = $request->_acara;

        //dd($this->acara_id);

        $acara = Acara::all();

        
        return view('pengunjung.index',['title'=>'Pengunjung','acara'=>$acara,'acara_id'=>$this->acara_id]);
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
