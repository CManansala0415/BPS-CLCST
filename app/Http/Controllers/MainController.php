<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use DateTime;

class MainController extends Controller
{
    public function getDegree($type)
    {
        
        $degree = DB::table('sett_degree')->orderBy('deg_id')
        ->where('deg_type','=',$type)
        ->get();
        return $degree;

    }
    public function getProgram()
    {
        $program = DB::table('sett_degree_types')->orderBy('dtype_id')
        ->get();
        return $program;
    }
    public function getQuarter()
    {
        $quarter = DB::table('sett_quarter')->orderBy('quar_id')
        ->get();
        return $quarter;
    }
    public function getSemester()
    {
        $semester = DB::table('sett_semester')->orderBy('sem_id')
        ->get();
        return $semester;
    }
    public function getProgramList()
    {
        $programs = DB::table('def_program')
        ->get();
        return $programs;
    }

    public function saveCourseCollege(Request $request)
    {
        // DB::table('def_program')->insert([
        //     'prog_code' => $request->input('prog_code'),
        //     'prog_name' => $request->input('prog_name'),
        //     'prog_desc' => $request->input('prog_desc'),
        //     'prog_degree' => $request->input('prog_degree'),
        //     'prog_year' => $request->input('prog_year'),
        //     'prog_progtype' => $request->input('prog_progtype'),
        //     'prog_semtype' => $request->input('prog_semtype'),
        //     'prog_semcount' => $request->input('prog_semcount'),
        // ]);

    }
    
}
