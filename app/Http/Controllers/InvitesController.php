<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class InvitesController extends Controller
{
    

    public function uploadFile(Request $request){

        $validator =  $request->validate([
            
            'file' => 'required|mimetypes:application/json',               
        ]);

        $content = '';

        $myArray = [];

            if($request->hasFile('file')){
            $content = File::get($request->file);

            $lines = preg_split("/\r\n|\n|\r/", $content);
            
            foreach($lines as $line)           
                $myArray[] = json_decode($line);
          
        }

       $myInvites = [];
        
        usort($myArray, array( $this, 'comparator' ));

        $lat1 = 53.3340285;
        $lon1 = -6.2535495;

        foreach($myArray as $obj){
            
            $lat2 = $obj->latitude;
            $lon2 = $obj->longitude;

            $distance = $this->getDistance($lat1, $lon1,$lat2, $lon2);
            $obj->distance = $distance;

             if($distance <= 100)
                $myInvites[] = $obj;
        }


       session(['invites' => $myInvites]);

        
       return redirect()->route('results');

    }

    public function results(Request $request){

        $myInvites = $request->session()->get('invites');

        return view("results", [ "invites" => $myInvites ]);
    }

    private function comparator($a, $b) 
    {
        if ($a->affiliate_id == $b->affiliate_id) return 0;
        return $a->affiliate_id < $b->affiliate_id ?-1:1;
    }

    private function getDistance($lat1, $lon1,$lat2, $lon2)
    {
        // distance between latitudes
        // and longitudes
        $dLat = ($lat2 - $lat1) *
                    M_PI / 180.0;
        $dLon = ($lon2 - $lon1) *
                    M_PI / 180.0;
     
        // convert to radians
        $lat1 = ($lat1) * M_PI / 180.0;
        $lat2 = ($lat2) * M_PI / 180.0;
     
        // apply formulae
        $a = pow(sin($dLat / 2), 2) +
             pow(sin($dLon / 2), 2) *
                 cos($lat1) * cos($lat2);
        $rad = 6371;
        $c = 2 * asin(sqrt($a));
        return ceil($rad * $c);
    }
    
}
