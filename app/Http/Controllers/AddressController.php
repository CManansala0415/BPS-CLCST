<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use DateTime;

class AddressController extends Controller
{
    
    public function getRegion()
    {
       
        $region = DB::table('sett_ph_region')->orderBy('regDesc')
        ->get();
        return $region; 
       
    }
    public function getProvince()
    {
       
        $province = DB::table('sett_ph_province')->orderBy('provDesc')
        ->get();
        return $province; 
       
    }
    public function getCity()
    {
       
        $city = DB::table('sett_ph_city')->orderBy('citymunDesc')
        ->get();
        return $city; 
       
    }
    public function getBarangay()
    {
       
        $barangay = DB::table('sett_ph_barangay')->orderBy('brgyDesc')
        ->get();
        return $barangay; 
       
    }

}
