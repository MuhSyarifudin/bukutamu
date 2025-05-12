<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = "pengunjung";
    protected $fillable = ['nama','alamat','no_telp','uang','status','acara_id','user_id'];
    public $timestamps = true;
}
