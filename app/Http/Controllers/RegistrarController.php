<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use DateTime;

class RegistrarController extends Controller
{
    public function getSubject()
    {
        
        // $subject = DB::table('def_subject')->orderBy('subj_id')
        // ->get();
        // return $subject;
        $subject = DB::table('def_curriculum_tags')
        ->leftJoin('def_subject', 'def_curriculum_tags.currtag_subjid', '=', 'def_subject.subj_id') 
        ->select(  
            'def_subject.*',
            'def_curriculum_tags.*',
        )->orderBy('def_curriculum_tags.currtag_id')
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
        
        $gradelvl = DB::table('def_gradelvl')->orderBy('grad_dtypeid')
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
                'grad_dtypeid' => $request->input('grad_dtypeid'),
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
                'grad_dtypeid' => $request->input('grad_dtypeid'),
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

    public function addCurriculum(Request $request)
    {
       try{
            $primary = DB::table('def_curriculum')->insert([
                'curr_code' => $request->input('curr_code'),
                'curr_desc' => $request->input('curr_desc'),
                'curr_from' => $request->input('curr_from'),
                'curr_to' => $request->input('curr_to'),
                'curr_progid' => $request->input('curr_progid'),
                'curr_progtype' => $request->input('curr_progtype'),
                'curr_gradelvlid' => $request->input('curr_gradelvlid'),
                'curr_semester' => $request->input('curr_semester'),
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function getProgramList()
    {
       
        $programs = DB::table('def_program')->orderBy('prog_progtype')
        ->get();
        return $programs; 
       
    }

    public function getCurriculum()
    {
       
        $curriculum = DB::table('def_curriculum')->orderBy('curr_id')
        ->get();
        return $curriculum; 
       
    }

    public function getCurriculumStudent($prog, $type)
    {
        
        $curriculum = DB::table('def_curriculum')->orderBy('curr_id')
        ->where('curr_progid', '=' , $prog)
        ->where('curr_progtype', '=' , $type)
        ->get();
        return $curriculum; 
       
    }

    public function getCurriculumSubject($curr)
    {
        $curriculum = DB::table('def_curriculum_tags')
            ->leftJoin('def_subject', 'def_curriculum_tags.currtag_subjid', '=', 'def_subject.subj_id') 
            ->select(  
                'def_subject.*',
                'def_curriculum_tags.*',
            )->orderBy('def_curriculum_tags.currtag_id')
            ->where('def_curriculum_tags.currtag_currid', '=' , $curr)
            ->get();
            return $curriculum;
       
    }

    public function getApplicant($limit, $offset, $search)
    {
        
        if($search==204){
            $applicant = DB::table('def_person')->where('per_status', '=',  1)->orderBy('per_id','DESC')->limit($limit)->offset($offset)->get();
            $count = DB::table('def_person')->count();
        }
        else{
            $applicant = DB::table('def_person')->orderBy('per_id','DESC')
                        ->where('per_status', '=',  1)
                        ->where(function($query) use ($search) {
                            $query->where('per_firstname', 'like',  '%' . $search .'%')
                            ->orWhere('per_middlename', 'like',  '%' . $search .'%')
                            ->orWhere('per_lastname', 'like',  '%' . $search .'%')
                            ->orWhere('per_suffixname', 'like',  '%' . $search .'%')
                            ->orWhere('per_dateapplied', 'like',  '%' . $search .'%');
                        })
                        ->limit($limit)->offset($offset)
                        ->get();
            $count =  DB::table('def_person')->orderBy('per_id','DESC')
                        ->where('per_status', '=',  1)
                        ->where(function($query) use ($search) {
                            $query->where('per_firstname', 'like',  '%' . $search .'%')
                            ->orWhere('per_middlename', 'like',  '%' . $search .'%')
                            ->orWhere('per_lastname', 'like',  '%' . $search .'%')
                            ->orWhere('per_suffixname', 'like',  '%' . $search .'%')
                            ->orWhere('per_dateapplied', 'like',  '%' . $search .'%');
                        })
                        ->limit($limit)->offset($offset)
                        ->count();       
        }

        return $data = [
            'data' => $applicant,
            'count' => $count,
        ];
        // return $applicant; 
        
        // date_default_timezone_set('Asia/Manila');
        // $date = date('Y/m/d h:i:s a', time());
        // return $date;
    }

    public function getCivilStatus()
    {
       
        $curriculum = DB::table('sett_civil_status')->orderBy('cv_id')
        ->where('cv_status', '=' , 1)
        ->get();
        return $curriculum; 
       
    }

    public function getGender()
    {
       
        $gender = DB::table('sett_gender')->orderBy('gen_id')
        ->where('gen_status', '=' , 1)
        ->get();
        return $gender; 
       
    }

    public function getNationality()
    {
       
        $nationality = DB::table('sett_nationality')->orderBy('nat_desc')
        ->where('nat_status', '=' , 1)
        ->get();
        return $nationality; 
       
    }
    

    public function getFamily($id)
    {
       
        $family = DB::table('def_person_family')
        ->where('fam_personid', '=' , $id)
        ->get();
        return $family; 
       
    }

    public function getAward($id)
    {
       
        $award = DB::table('def_person_award')
        ->where('awr_personid', '=' , $id)
        ->get();
        return $award; 
       
    }

    public function getAttainment($id)
    {
       
        $attainment = DB::table('def_person_attainment')
        ->where('pered_personid', '=' , $id)
        ->get();
        return $attainment; 
       
    }
    
    public function addApplicant(Request $request, $type)
    {
        switch($type){
            case 1:
                $format1 = substr($request->input('per_firstname'), 0, 2);
                $format2 = substr($request->input('per_middlename'), 0, 2);
                $format3 = substr($request->input('per_lastname'), 0, 2);

                $randomizer = uniqid();

                $famid = 'fam-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;
                $awrid = 'awr-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;
                $attid = 'att-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;
                $perid = 'per-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;

                try{
                    //date time saving last to fix naten
                    date_default_timezone_set('Asia/Manila');
                    $date = date('Y-m-d h:i:s', time());
                    $primary = DB::table('def_person')->insert([
                        'per_firstname' => $request->input('per_firstname'),
                        'per_middlename' => $request->input('per_middlename'),
                        'per_lastname' => $request->input('per_lastname'),
                        'per_suffixname' => $request->input('per_suffixname'),
                        'per_birthday' => $request->input('per_birthday'),
                        'per_birth_province' => $request->input('per_birth_province'),
                        'per_birth_city' => $request->input('per_birth_city'),
                        'per_birth_zipcode' => $request->input('per_birth_zipcode'),
                        'per_gender' => $request->input('per_gender'),
                        'per_civilstatus' => $request->input('per_civilstatus'),
                        'per_nationality' => $request->input('per_nationality'),
                        'per_contact' => $request->input('per_contact'),
                        'per_email' => $request->input('per_email'),
                        'per_curr_home' => $request->input('per_curr_home'),
                        'per_curr_region' => $request->input('per_curr_region'),
                        'per_curr_province' => $request->input('per_curr_province'),
                        'per_curr_city' => $request->input('per_curr_city'),
                        'per_curr_barangay' => $request->input('per_curr_barangay'),
                        'per_curr_zipcode' => $request->input('per_curr_zipcode'),
                        'per_perm_home' => $request->input('per_perm_home'),
                        'per_perm_region' => $request->input('per_perm_region'),
                        'per_perm_province' => $request->input('per_perm_province'),
                        'per_perm_city' => $request->input('per_perm_city'),
                        'per_perm_barangay' => $request->input('per_perm_barangay'),
                        'per_perm_zipcode' => $request->input('per_perm_zipcode'),
                        'per_educid' => $awrid,
                        'per_famid' => $famid,
                        'per_attainmentid' => $attid,
                        'per_personid' => $perid,
                        'per_regtype' => $request->input('per_regtype'),
                        'per_dateapplied' =>$date,
                        'per_user' =>$request->input('per_user'),
                        
                    ]);

                    return $data = [
                        'fam_id' => $famid,
                        'educ_id' => $awrid,
                        'att_id' => $attid,
                        'status' => 204,
                    ];
                }
                catch (Exception $ex) {
                    return $data = [
                        'status' => 500,
                    ];
                }

                
            break;
            case 2:
                 try{
                    $primary = DB::table('def_person_family')->insert([
                        'fam_personid' => $request->input('fam_personid'),
                        'fam_firstname' => $request->input('fam_firstname'),
                        'fam_middlename' => $request->input('fam_middlename'),
                        'fam_lastname' => $request->input('fam_lastname'),
                        'fam_suffixname' => $request->input('fam_suffixname'),
                        'fam_relationship' => $request->input('fam_relationship'),
                        'fam_contact' => $request->input('fam_contact'),
                        'fam_email' => $request->input('fam_email'),
                    ]);
                    
                    return $data = [
                        'status' => 204,
                    ];
                }
                catch (Exception $ex) {
                    return $data = [
                        'status' => 500,
                    ];
                }
            break;
            case 3:
                try{
                    $primary = DB::table('def_person_award')->insert([
                        'awr_personid' => $request->input('awr_personid'),
                        'awr_desc' => $request->input('awr_desc'),
                        'awr_year' => $request->input('awr_year'),
                    ]);
                    
                    return $data = [
                        'status' => 204,
                    ];
                }
                catch (Exception $ex) {
                    return $data = [
                        'status' => 500,
                    ];
                }
            break;
            case 4:
                try{
                    $primary = DB::table('def_person_attainment')->insert([
                        'pered_personid' => $request->input('pered_personid'),
                        'pered_school' => $request->input('pered_school'),
                        'pered_from' => $request->input('pered_from'),
                        'pered_to' => $request->input('pered_to'),
                    ]);
                    
                    return $data = [
                        'status' => 204,
                    ];
                }
                catch (Exception $ex) {
                    return $data = [
                        'status' => 500,
                    ];
                }
            break;
        }
    }

    public function updateApplicant(Request $req)
    {
        try{
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d h:i:s', time());
            $s1 = DB::table('def_person')
                ->where('per_id','=', $req['per_id'])
                ->update([
                    "per_id" => $req['per_id'],
                    "per_firstname" => $req['per_firstname'],
                    "per_middlename" => $req['per_middlename'],
                    "per_lastname" => $req['per_lastname'],
                    "per_suffixname" => $req['per_suffixname'],
                    "per_birthday" => $req['per_birthday'],
                    "per_birth_province" => $req['per_birth_province'],
                    "per_birth_city" => $req['per_birth_city'],
                    "per_birth_zipcode" => $req['per_birth_zipcode'],
                    "per_gender" => $req['per_gender'],
                    "per_civilstatus" => $req['per_civilstatus'],
                    "per_nationality" => $req['per_nationality'],
                    "per_contact" => $req['per_contact'],
                    "per_email" => $req['per_email'],
                    "per_curr_home" => $req['per_curr_home'],
                    "per_curr_country" => $req['per_curr_country'],
                    "per_curr_region" => $req['per_curr_region'],
                    "per_curr_province" => $req['per_curr_province'],
                    "per_curr_city" => $req['per_curr_city'],
                    "per_curr_barangay" => $req['per_curr_barangay'],
                    "per_curr_zipcode" => $req['per_curr_zipcode'],
                    "per_perm_home" => $req['per_perm_home'],
                    "per_perm_country" => $req['per_perm_country'],
                    "per_perm_region" => $req['per_perm_region'],
                    "per_perm_province" => $req['per_perm_province'],
                    "per_perm_city" => $req['per_perm_city'],
                    "per_perm_barangay" => $req['per_perm_barangay'],
                    "per_perm_zipcode" => $req['per_perm_zipcode'],
                    "per_regtype" => $req['per_regtype'],
                    "per_updatedby" =>$req['per_user'],
                    "per_dateupdated" => $date,
                ]);
            
            return $data = [
                'status' => 204,
            ];
        }
        catch (Exception $ex) {
            return $data = [
                'status' => 500,
            ];
        }
        
       
    }

    public function deleteApplicant(Request $req)
    {
        try{
            $s1 = DB::table('def_person')
                ->where('per_id','=', $req['per_id'])
                ->update([
                    "per_status" => 0,
                ]);
            
            return $data = [
                'status' => 204,
            ];
        }
        catch (Exception $ex) {
            return $data = [
                'status' => 500,
            ];
        }
        
       
    }
    public function enrollApplicant(Request $request)
    {
       try{
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d h:i:s', time());

            $primary = DB::table('def_enrollment')->insert([
                'enr_enrby' => $request->input('userid'),
                'enr_personid' => $request->input('personid'),
                'enr_gradelvl' => $request->input('gradelvl'),
                'enr_program' => $request->input('program'),
                'enr_quarter' => $request->input('quarter'),
                'enr_course' => $request->input('course'),
                'enr_dateenrolled' => $date
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function getEnrollment($id)
    {
       
        // $enrollment = DB::table('def_enrollment')
        // ->where('enr_personid', '=' , $id)->get();
        // // ->first();
        // return $enrollment; 

        $enrollment = DB::table('def_enrollment')
            ->leftJoin('def_gradelvl', 'def_enrollment.enr_gradelvl', '=', 'def_gradelvl.grad_id') 
            ->leftJoin('sett_quarter', 'def_enrollment.enr_quarter', '=', 'sett_quarter.quar_id') 
            ->leftJoin('def_program', 'def_enrollment.enr_course', '=', 'def_program.prog_id') 
            ->leftJoin('def_curriculum', 'def_enrollment.enr_curriculum', '=', 'def_curriculum.curr_id') 
            ->leftJoin('def_section', 'def_enrollment.enr_section', '=', 'def_section.sec_id') 

            ->select(  
                'def_enrollment.*',
                'def_gradelvl.*',
                'def_program.*',
                'def_curriculum.*',
                'def_section.*',
                'sett_quarter.*',
            )
            ->orderBy('def_enrollment.enr_dateenrolled','DESC')
            ->where('def_enrollment.enr_personid', '=' , $id)
            ->get();
        return $enrollment; 
       
    }





    public function getStudent($limit, $offset, $search)
    {
        if($search==204){

            $student = DB::table('def_enrollment')
            ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
            ->select(  
                'def_enrollment.*',
                'def_person.*',
            )->orderBy('def_person.per_id','DESC')
            ->limit($limit)
            ->offset($offset)
            ->get();
                            

            $count = DB::table('def_enrollment')
            ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
            ->select(  
                'def_enrollment.*',
                'def_person.*',
            )->count();
        }
        else{
             $student = DB::table('def_enrollment')
                        ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
                        ->select(  
                            'def_enrollment.*',
                            'def_person.*',
                        )->orderBy('def_person.per_id','DESC')
                        ->where('per_status', '=',  1)
                        ->where(function($query) use ($search) {
                            $query->where('per_firstname', 'like',  '%' . $search .'%')
                            ->orWhere('per_middlename', 'like',  '%' . $search .'%')
                            ->orWhere('per_lastname', 'like',  '%' . $search .'%')
                            ->orWhere('per_suffixname', 'like',  '%' . $search .'%')
                            ->orWhere('per_dateapplied', 'like',  '%' . $search .'%');
                        })
                        ->limit($limit)->offset($offset)
                        ->get();
            $count =  DB::table('def_enrollment')
                        ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
                        ->select(  
                            'def_enrollment.*',
                            'def_person.*',
                        )->orderBy('def_person.per_id','DESC')
                        ->where('per_status', '=',  1)
                        ->where(function($query) use ($search) {
                            $query->where('per_firstname', 'like',  '%' . $search .'%')
                            ->orWhere('per_middlename', 'like',  '%' . $search .'%')
                            ->orWhere('per_lastname', 'like',  '%' . $search .'%')
                            ->orWhere('per_suffixname', 'like',  '%' . $search .'%')
                            ->orWhere('per_dateapplied', 'like',  '%' . $search .'%');
                        })
                        ->limit($limit)->offset($offset)
                        ->count();       
        }

        return $data = [
            'data' => $student,
            'count' => $count,
        ];
    }

    public function getStudentByCourse($limit, $offset, $search)
    {
        if($search==204){

            $student = DB::table('def_enrollment')
            ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
            ->select(  
                'def_enrollment.*',
                'def_person.*',
            )->orderBy('def_person.per_id','DESC')
            ->limit($limit)
            ->offset($offset)
            ->get();
                            

            $count = DB::table('def_enrollment')
            ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
            ->select(  
                'def_enrollment.*',
                'def_person.*',
            )->count();
        }
        else{
             $student = DB::table('def_enrollment')
                        ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
                        ->select(  
                            'def_enrollment.*',
                            'def_person.*',
                        )->orderBy('def_person.per_id','DESC')
                        ->where('per_status', '=',  1)
                        ->where('enr_course', '=',  $search)
                        ->limit($limit)->offset($offset)
                        ->get();
            $count =  DB::table('def_enrollment')
                        ->leftJoin('def_person', 'def_enrollment.enr_personid', '=', 'def_person.per_personid') 
                        ->select(  
                            'def_enrollment.*',
                            'def_person.*',
                        )->orderBy('def_person.per_id','DESC')
                        ->where('per_status', '=',  1)
                        ->where('enr_course', '=',  $search)
                        ->limit($limit)->offset($offset)
                        ->count();       
        }

        return $data = [
            'data' => $student,
            'count' => $count,
        ];
    }

    public function addMilestone(Request $request)
    {
        
        // date_default_timezone_set('Asia/Manila');
        // $date = date('Y-m-d h:i:s', time());
        // $primary = DB::table('def_milestone')->insert([
        //     'mi_enrid' =>  $request->input('enr_id'),
        //     'mi_subjid' =>  $request->input('subj_id'),
        //     'mi_completed' =>  0,
        //     'mi_date' =>  $date,
        //     'mi_addby' => $request->input('user_id')
        // ]);
        $milestone = DB::table('def_milestone')
            ->select('mi_id')
            ->where('mi_enrid', '=' , $request->input('enr_id'))
            ->where('mi_subjid', '=' , $request->input('subj_id'))
            ->first();

        if($milestone){
            $milestoneid = $milestone->mi_id;

            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d h:i:s', time());
            $primary = DB::table('def_milestone')
            ->where('mi_id','=', $milestoneid)
            ->update([
                'mi_updatedby' => $request->input('user_id'),
                'mi_crossenr' => $request->input('mi_crossenr'),
                'mi_tag' => $request->input('mi_tag'),
                'mi_dateupdated' => $date,
            ]);

        }else{
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d h:i:s', time());
            $primary = DB::table('def_milestone')->insert([
                'mi_enrid' =>  $request->input('enr_id'),
                'mi_subjid' =>  $request->input('subj_id'),
                'mi_crossenr' =>  $request->input('crossenr'),
                'mi_tag' =>  $request->input('mi_tag'),
                'mi_completed' =>  0,
                'mi_date' =>  $date,
                'mi_addby' => $request->input('user_id')
            ]);
        }
        return 200; 
       
    }

    public function getMilestone($id)
    {
        $milestone = DB::table('def_milestone')
            ->leftJoin('def_enrollment', 'def_milestone.mi_enrid', '=', 'def_enrollment.enr_id') 
            ->leftJoin('def_subject', 'def_milestone.mi_subjid', '=', 'def_subject.subj_id') 
            ->select(  
                'def_enrollment.*',
                'def_milestone.*',
                'def_subject.*'
            )
            ->orderBy('def_enrollment.enr_dateenrolled','ASC')
            ->where('def_milestone.mi_enrid', '=' , $id)
            ->where('def_milestone.mi_status', '=' , 1)
            ->get();
        return $milestone; 
       
    }

    public function updateEnrollment(Request $request){
        try{
            
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d h:i:s', time());
            $primary = DB::table('def_enrollment')
            ->where('enr_id','=', $request->input('enr_id'))
            ->update([
                'enr_curriculum' => $request->input('enr_curriculum'),
                'enr_section' => $request->input('enr_section'),
                'enr_updatedby' => $request->input('enr_updatedby'),
                'enr_dateupdated' => $date,
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }

    public function updateMilestone(Request $request)
    {
        try{
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d h:i:s', time());
            $primary = DB::table('def_milestone')
            ->where('mi_id','=', $request->input('mi_id'))
            ->update([
                'mi_status' => $request->input('mi_status'),
                'mi_updatedby' => $request->input('mi_updatedby'),
                'mi_dateupdated' => $date,
            ]);
            return 204;
        }
        catch (Exception $ex) {
            return 500;
        }
    }
    
}
