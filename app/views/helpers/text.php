<?php
/**
 * Text Helper Class
 * 
 * Shamelessly gotten from Codeigniter TextHelper Class
 * Converted to Cakephp Helper
 */
 
class TextHelper extends Helper {
	
	/**
	 * Word limt function
	 * @usage $text->wlimit(String, Limit);
	**/
	function wlimit($str, $limit = 100, $end_char = '&#8230;'){
		
		if (trim($str) == ''){
			return $str;
		}
		
		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);	
		
		if (strlen($str) == strlen($matches[0])) {
			$end_char = '';
		}
	
		return rtrim($matches[0]) . $end_char;
	
	}

	/**
	 * Character Limit function
	 *
	 *@usage $text->climit($string, $number)
	**/
	function climit($str, $n = 50, $end_char = '&#8230;'){
		
		if (strlen($str) < $n){
			return $str;
		}
		
		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n) {
			return $str;
		}
									
		$out = "";
		foreach (explode(' ', trim($str)) as $val) {
			$out .= $val.' ';			
			if (strlen($out) >= $n)
			{
				return trim($out).$end_char;
			}		
		}
	}
	
}
?>