<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Surat extends Model 
{
    protected $table = "surat";

    protected $fillable = [
        'no_surat', 'tanggal', 'jenis_id', 'perihal'
    ];

    protected $hidden = [];

}
