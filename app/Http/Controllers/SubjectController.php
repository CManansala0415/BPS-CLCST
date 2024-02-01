<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use DateTime;

class SubjectController extends Controller
{
    public function getSubject()
    {
        
        $subject = DB::table('def_subject')->orderBy('subj_code')
        ->get();
        return $subject;

    }
}
