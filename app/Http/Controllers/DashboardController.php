<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Akaunting\Money\Money;
use App\Models\Acara;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jmlh_uang = Pengunjung::where('user_id',Auth::user()->id)->sum('uang');
        $jmlh_pengunjung = Pengunjung::where('user_id',Auth::user()->id)->count();
        $jmlh_acara = Acara::where('user_id',Auth::user()->id)->count();

        return view('dashboard',['title'=>'Dashboard','jmlh_uang'=>Money::IDR($jmlh_uang,true),'jmlh_pengunjung'=>$jmlh_pengunjung,'jmlh_acara'=>$jmlh_acara,'active_menu'=>'dashboard']);
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
