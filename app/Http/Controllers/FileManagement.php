<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FileManagement extends Controller
{
    public function uploadProfile(Request $request) {
        // $pathToFile = $request->file('image')->store('images', 'public');
        $pathToFile = $request->file('image');
        $pathToFile->storeAs(
            'profiles',
            $pathToFile->getClientOriginalName(),
            'public'
        );
        // return $pathToFile;
        if($pathToFile){
            return $data = [
                'status' => 200,
                'link' =>  $pathToFile->getClientOriginalName(),
            ];
        }else{
            return $data = [
                'status' => 500,
            ];
        }
    } 
    public function uploadLink(Request $request) {
        $s1 = DB::table('def_person')
                ->where('per_id','=', $request['personid'])
                ->update([
                    "per_profile" => $request['profile'],
                ]);
            
            return $data = [
                'status' => 200,
            ];
    } 
}
