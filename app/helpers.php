<?php

if ( ! function_exists('prettify_text')){
    function prettify_text($text){

        if (strstr($text, '_')){
            $words = preg_split('/_/', $text);
        }else{
            $words = preg_split('/(?=[A-Z])/', $text);
        }


        
        $display = implode(' ', $words);
        return ucwords($display);
    }
}
