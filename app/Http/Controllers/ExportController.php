<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PengunjungExport;
use App\Models\Acara;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export_pengunjung($acara_id){
        $acara = Acara::where('id',$acara_id)->first();
        return Excel::download(new PengunjungExport($acara_id), ''.$acara->nama.'.xlsx');
    }
}
