<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use DateTime;

class ProgramController extends Controller
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
    public function getProgramList($id)
    {
        if(!$id){
            $programs = DB::table('def_program')
            ->get();
            return $programs;
        }else{
            $programs = DB::table('def_program')
            ->leftJoin('def_program_years', 'def_program.prog_id', '=', 'def_program_years.dprog_progid') 
            ->select(  
                'def_program.*',
                'def_program_years.*',
            )
            ->where('def_program.prog_id','=',$id)
            ->get();
            return $programs;
        }
    }

    public function saveProgram(Request $request)
    {
        if($request->input('mode') == 2){

            try{
                $primary = DB::table('def_program')
                ->where('prog_id','=', $request->input('id'))
                ->update([
                    'prog_code' => $request->input('prog_code'),
                    'prog_name' => $request->input('prog_name'),
                    'prog_desc' => $request->input('prog_desc'),
                    'prog_degree' => $request->input('prog_degree'),
                    'prog_year' => $request->input('prog_year'),
                    'prog_progtype' => $request->input('prog_progtype'),
                    'prog_semtype' => $request->input('prog_semtype'),
                    'prog_semcount' => $request->input('prog_semcount'),
                ]);

                $dprog_y1 = $request->input('dprog_y1');
                $s1 = DB::table('def_program_years')
                ->where('dprog_id','=', $dprog_y1['year1_id'])
                ->where('dprog_progid','=', $request->input('id'))
                ->update([
                    'dprog_year' => 1,
                    'dprog_s1' => $dprog_y1['semester_1_units'],
                    'dprog_s2' => $dprog_y1['semester_2_units'],
                    'dprog_s3' => $dprog_y1['semester_3_units'],
                    
                    'dprog_q1' => $dprog_y1['quarter_1_units'],
                    'dprog_q2' => $dprog_y1['quarter_2_units'],
                    'dprog_q3' => $dprog_y1['quarter_3_units'],
                    'dprog_q4' => $dprog_y1['quarter_4_units'],

                ]);

                $dprog_y2 = $request->input('dprog_y2');
                $s2 = DB::table('def_program_years')
                ->where('dprog_id','=', $dprog_y2['year2_id'])
                ->where('dprog_progid','=', $request->input('id'))
                ->update([
                    'dprog_year' => 2,
                    'dprog_s1' => $dprog_y2['semester_1_units'],
                    'dprog_s2' => $dprog_y2['semester_2_units'],
                    'dprog_s3' => $dprog_y2['semester_3_units'],
                    
                    'dprog_q1' => $dprog_y2['quarter_1_units'],
                    'dprog_q2' => $dprog_y2['quarter_2_units'],
                    'dprog_q3' => $dprog_y2['quarter_3_units'],
                    'dprog_q4' => $dprog_y2['quarter_4_units'],

                ]);
                
                if($request->input('prog_progtype') == 2){
                    $dprog_y3 = $request->input('dprog_y3');
                    $s3 = DB::table('def_program_years')
                    ->where('dprog_id','=', $dprog_y3['year3_id'])
                    ->where('dprog_progid','=', $request->input('id'))
                    ->update([
                        'dprog_year' => 3,
                        'dprog_s1' => $dprog_y3['semester_1_units'],
                        'dprog_s2' => $dprog_y3['semester_2_units'],
                        'dprog_s3' => $dprog_y3['semester_3_units'],
                    ]);
    
                    $dprog_y4 = $request->input('dprog_y4');
                    $s4 = DB::table('def_program_years')
                    ->where('dprog_id','=', $dprog_y4['year4_id'])
                    ->where('dprog_progid','=', $request->input('id'))
                    ->update([
                        'dprog_year' => 4,
                        'dprog_s1' => $dprog_y4['semester_1_units'],
                        'dprog_s2' => $dprog_y4['semester_2_units'],
                        'dprog_s3' => $dprog_y4['semester_3_units'],
                    ]);
                }

                return 204;
                            
            } catch (Exception $ex) {
                return 500;
            }
           

        }else{

            $primary = DB::table('def_program')->insert([
                'prog_code' => $request->input('prog_code'),
                'prog_name' => $request->input('prog_name'),
                'prog_desc' => $request->input('prog_desc'),
                'prog_degree' => $request->input('prog_degree'),
                'prog_year' => $request->input('prog_year'),
                'prog_progtype' => $request->input('prog_progtype'),
                'prog_semtype' => $request->input('prog_semtype'),
                'prog_semcount' => $request->input('prog_semcount'),
            ]);
    
            if($primary){
                $progdata = DB::table('def_program')
                ->select('prog_id')
                ->where('prog_code','=', $request->input('prog_code'))
                ->first();
    
                if($progdata){
                    $yearid = $progdata->prog_id;
                    try {
                        $dprog_y1 = $request->input('dprog_y1');
                        $s1 = DB::table('def_program_years')->insert([
                            'dprog_progid' => $yearid,
                            'dprog_year' => 1,
                            'dprog_s1' => $dprog_y1['semester_1_units'],
                            'dprog_s2' => $dprog_y1['semester_2_units'],
                            'dprog_s3' => $dprog_y1['semester_3_units'],
    
                            'dprog_q1' => $dprog_y1['quarter_1_units'],
                            'dprog_q2' => $dprog_y1['quarter_2_units'],
                            'dprog_q3' => $dprog_y1['quarter_3_units'],
                            'dprog_q4' => $dprog_y1['quarter_4_units'],
    
                        ]);
        
                        $dprog_y2 = $request->input('dprog_y2');
                        $s2 = DB::table('def_program_years')->insert([
                            'dprog_progid' => $yearid,
                            'dprog_year' => 2,
                            'dprog_s1' => $dprog_y2['semester_1_units'],
                            'dprog_s2' => $dprog_y2['semester_2_units'],
                            'dprog_s3' => $dprog_y2['semester_3_units'],
    
                            'dprog_q1' => $dprog_y2['quarter_1_units'],
                            'dprog_q2' => $dprog_y2['quarter_2_units'],
                            'dprog_q3' => $dprog_y2['quarter_3_units'],
                            'dprog_q4' => $dprog_y2['quarter_4_units'],
    
                        ]);
                        
                        if($request->input('prog_progtype') == 2){
                            $dprog_y3 = $request->input('dprog_y3');
                            $s3 = DB::table('def_program_years')->insert([
                                'dprog_progid' => $yearid,
                                'dprog_year' => 3,
                                'dprog_s1' => $dprog_y3['semester_1_units'],
                                'dprog_s2' => $dprog_y3['semester_2_units'],
                                'dprog_s3' => $dprog_y3['semester_3_units'],
                            ]);
            
                            $dprog_y4 = $request->input('dprog_y4');
                            $s4 = DB::table('def_program_years')->insert([
                                'dprog_progid' => $yearid,
                                'dprog_year' => 4,
                                'dprog_s1' => $dprog_y4['semester_1_units'],
                                'dprog_s2' => $dprog_y4['semester_2_units'],
                                'dprog_s3' => $dprog_y4['semester_3_units'],
                            ]);
                        }
                        
                        return 204;
                        
                    } catch (Exception $ex) {
                        return 500;
                    }
                   
                }
                 
            }
        }
        
    }
    
}
