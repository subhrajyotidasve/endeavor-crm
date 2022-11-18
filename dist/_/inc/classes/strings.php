<?php

class Strings {

	public static function replaceAll($text) {

	    $text = strtolower(htmlentities($text));
	    $text = str_replace(get_html_translation_table(), "-", $text);
	    $text = str_replace(" ", "-", $text);
	    $text = preg_replace("/[-]+/i", "-", $text);

	    return $text;
	}

	public static function validateString($string) {

	    if ($string) {

	        $string = trim($string);

	        if ($string === '') {

	            return 'required';
	        }
	    } else {

	    	return 'required';
	    }
	}

	public static function removeComma($num) {

		$num = str_replace(',','',$num);
		$num = str_replace('£','',$num);
		$num = floatval($num);

		return $num;
	}

	public static function priceExVat($price) {
		
		$math = ($price / 100) * 80;

	    return self::price_format($math);
	}

	// Minimum eight characters, at least one uppercase letter, one lowercase letter, one number.
	public static function validate_password($password) {

		if (preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {

			return true;

		} else {

			return false;
		}
	}

	public static function price_format($price, $precision = 2) {

		$price = number_format($price, 2);
		return $price;
		// return floor($price * 100) / 100;
//    	return floor($price) . substr(str_replace(floor($price), '', $price), 0, $precision + 1);
//        above line removed as it was removing decimal places in cart & checkout
	}
}
