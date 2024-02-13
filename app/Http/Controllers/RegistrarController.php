<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use DateTime;

class RegistrarController extends Controller
{
    public function getSubject()
    {
        
        $subject = DB::table('def_subject')->orderBy('subj_id')
        ->get();
        return $subject;

    }

    public function getSection()
    {
        
        $section = DB::table('def_section')->orderBy('sec_id')
        ->get();
        return $section;

    }
    public function getGradelvl()
    {
        
        $gradelvl = DB::table('def_gradelvl')->orderBy('grad_id')
        ->get();
        return $gradelvl;

    }
    public function getClassroom()
    {
        
        $classroom = DB::table('def_classroom')
        ->leftJoin('sett_room_types', 'def_classroom.classr_rtype', '=', 'sett_room_types.rmtype_id') 
        ->select(  
            'def_classroom.*',
            'sett_room_types.*',
        )
        ->get();
        return $classroom;

    }

    public function getRoomType()
    {
        
        $roomtype = DB::table('sett_room_types')->orderBy('rmtype_code')
        ->get();
        return $roomtype;

    }

    public function getBuildingType()
    {
        
        $buildingtype = DB::table('sett_building')->orderBy('buil_code')
        ->get();
        return $buildingtype;

    }

    public function getDepartment()
    {
        
        $department = DB::table('def_department')->orderBy('dep_code')
        ->get();
        return $department;

    }

    public function saveSection(Request $request)
    {
        
       try{
            $primary = DB::table('def_section')
            ->where('sec_id','=', $request->input('sec_id'))
            ->update([
                'sec_code' => $request->input('sec_code'),
                'sec_name' => $request->input('sec_name'),
                'sec_status' => $request->input('sec_status'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }

    }

    public function saveGradelvl(Request $request)
    {
        
       try{
            $primary = DB::table('def_gradelvl')
            ->where('grad_id','=', $request->input('grad_id'))
            ->update([
                'grad_code' => $request->input('grad_code'),
                'grad_name' => $request->input('grad_name'),
                'grad_status' => $request->input('grad_status'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }

    }

    public function saveClassroom(Request $request)
    {
        
       try{
            $primary = DB::table('def_classroom')
            ->where('classr_id','=', $request->input('classr_id'))
            ->update([
                'classr_code' => $request->input('classr_code'),
                'classr_name' => $request->input('classr_name'),
                'classr_rtype' => $request->input('classr_rtype'),
                'classr_bid' => $request->input('classr_bid'),
                'classr_status' => $request->input('classr_status'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }

    }

    public function saveSubject(Request $request)
    {
       try{
            $primary = DB::table('def_subject')
            ->where('subj_id','=', $request->input('subj_id'))
            ->update([
                'subj_code' => $request->input('subj_code'),
                'subj_name' => $request->input('subj_name'),
                'subj_desc' => $request->input('subj_desc'),
                'subj_status' => $request->input('subj_status'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function saveDepartment(Request $request)
    {
       try{
            $primary = DB::table('def_department')
            ->where('dep_id','=', $request->input('dep_id'))
            ->update([
                'dep_code' => $request->input('dep_code'),
                'dep_name' => $request->input('dep_name'),
                'dep_status' => $request->input('dep_status'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function getDegree()
    {
        
        $degree = DB::table('sett_degree')->orderBy('deg_id')
        ->get();
        return $degree;

    }

    public function saveProgram(Request $request)
    {
       try{
            $primary = DB::table('def_program')
            ->where('prog_id','=', $request->input('prog_id'))
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
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function addProgram(Request $request)
    {
       try{
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
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function addSection(Request $request)
    {
       try{
            $primary = DB::table('def_section')->insert([
                'sec_code' => $request->input('sec_code'),
                'sec_name' => $request->input('sec_name'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function addGradelvl(Request $request)
    {
       try{
            $primary = DB::table('def_gradelvl')->insert([
                'grad_code' => $request->input('grad_code'),
                'grad_name' => $request->input('grad_name'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function addSubject(Request $request)
    {
       try{
            $primary = DB::table('def_subject')->insert([
                'subj_code' => $request->input('subj_code'),
                'subj_name' => $request->input('subj_name'),
                'subj_desc' => $request->input('subj_desc'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function addDepartment(Request $request)
    {
       try{
            $primary = DB::table('def_department')->insert([
                'dep_code' => $request->input('dep_code'),
                'dep_name' => $request->input('dep_name'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function addClassroom(Request $request)
    {
       try{
            $primary = DB::table('def_classroom')->insert([
                'classr_code' => $request->input('classr_code'),
                'classr_name' => $request->input('classr_name'),
                'classr_rtype' => $request->input('classr_rtype'),
                'classr_bid' => $request->input('classr_bid'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    
    
}
