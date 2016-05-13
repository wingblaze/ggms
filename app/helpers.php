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

if ( ! function_exists('smart_enumerate')){
	function smart_enumerate($array){
		$result = '';
		$count = count($array);
		if ($count > 2){
			for ($i = 0; $i < $count - 1; $i++){
				$result .= $array[$i] . ', ';
			}
			$result .= 'and ' . $array[$i];
			return $result;
		}else if ($count == 2){
			return $array[0] . ' and ' . $array[1];
		}else{
			return $array[0];
		}
	}
}