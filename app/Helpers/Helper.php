<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class Helper
{
public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function knownSubmenus(){
        return [
            'create' => 'Create',
            'index' => 'Index',
            'store' => 'Store',
            'edit' => 'Edit',
            'update' => 'Update',
            'show' => 'Show',
            'destroy' => 'Destroy',
            'print' => 'Print',

        ];
    }

    public static function regexSpecChar($string) {
        $cleanedString = preg_replace('/[^A-Za-zÑñ\s]/u', '', trim($string));

        return $cleanedString;
    }

    public static function sidenav_labeler($acronym){
        $labels = [
            'ADMIN' => 'Admin Menu',
            'ACCOUNTING' => 'Accounting Menu',
            'MAIN' => 'Main Menu',
        ];

        if(isset($labels[$acronym])){
            return $labels[$acronym];
        }else{
            return $acronym;
        }
    }

    public static function deviceInfo(){
        $dev = collect();
        $user_agent = request()->header('User-Agent');
        $bname = 'Unknown';
        $platform = 'Unknown';

        //First get the platform?
        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'windows';
        }else{
            $platform = 'not detected';
        }

//        echo $platform;

        $dev->platform = strtoupper($platform);


        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$user_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$user_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$user_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$user_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }else{
            $bname = 'Not detected';
        }
        $dev->browser = ucfirst($bname);

        return $dev;
    }
    
}