<?php 
/*
	include "convert_number_encoding.php";
	convertToEnglishNumber($unicodeNumber)
*/
	function convertToEnglishNumber($unicodeNumber){
		//$englishNumber = mb_convert_encoding($unicodeNumber,"HTML-ENTITIES","UTF-8");
		$englishNumber = $unicodeNumber;
		$englishNumber = str_replace('০', '0', $englishNumber);
		$englishNumber = str_replace('১', '1', $englishNumber);
		$englishNumber = str_replace('২', '2', $englishNumber);
		$englishNumber = str_replace('৩', '3', $englishNumber);
		$englishNumber = str_replace('৪', '4', $englishNumber);
		$englishNumber = str_replace('৫', '5', $englishNumber);
		$englishNumber = str_replace('৬', '6', $englishNumber);
		$englishNumber = str_replace('৭', '7', $englishNumber);
		$englishNumber = str_replace('৮', '8', $englishNumber);
		$englishNumber = str_replace('৯', '9', $englishNumber);
		return $englishNumber;
	}
	function convertToBanglaNumber($unicodeNumber){
	//$englishNumber = mb_convert_encoding($unicodeNumber,"HTML-ENTITIES","UTF-8");
	$banglaNumber = $unicodeNumber;
	$banglaNumber = str_replace('0', '০', $banglaNumber);
	$banglaNumber = str_replace('1', '১', $banglaNumber);
	$banglaNumber = str_replace('2', '২', $banglaNumber);
	$banglaNumber = str_replace('3', '৩', $banglaNumber);
	$banglaNumber = str_replace('4', '৪', $banglaNumber);
	$banglaNumber = str_replace('5', '৫', $banglaNumber);
	$banglaNumber = str_replace('6', '৬', $banglaNumber);
	$banglaNumber = str_replace('7', '৭', $banglaNumber);
	$banglaNumber = str_replace('8', '৮', $banglaNumber);
	$banglaNumber = str_replace('9', '৯', $banglaNumber);
	return $banglaNumber;
	}
