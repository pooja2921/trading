<?php
namespace App\ControllerHelpers;
use Mail;

class GeneralHelper
{
    
	public static function sendMail($path, $data, $to, $subject){
        //return  $data;
        Mail::send($path, $data, function($message) use($to, $subject)
        {
            $message->to($to)->subject($subject);
        });

    }

    public static function replaceStringAndExplode($str)
    {
        $replace_words = array(",","\r\n","/\s+/","\n",",,");
        $repleace_string = str_replace($replace_words, $replace_words[0], $str);
        return $srting = explode($replace_words[0], $repleace_string);
    }


}
