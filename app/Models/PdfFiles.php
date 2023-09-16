<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PdfFiles extends Model
{
    use HasFactory;

    function getData(){

        // return DB::table('users')
        //     ->join('pdf_files', 'users.id', '=', 'pdf_files.user_id')
        //     ->select('users.*', 'users.id as user_id', 'pdf_files.*')
        //     ->get();
    }
}
