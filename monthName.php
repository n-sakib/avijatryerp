<?php 
	function monthName($monthNumber){
		//$monthName = "নেই";
		$monthName = "$monthNumber";
		if($monthNumber == 01){
			$monthName = "জানুয়ারি";
		} 
		elseif($monthNumber == 02){
			$monthName = "ফেব্রুয়ারি";
		} 
		elseif($monthNumber == 03){
			$monthName = "মার্চ";
		} 
		elseif($monthNumber == 04){
			$monthName = "এপ্রিল";
		} 
		elseif($monthNumber == 05){
			$monthName = "মে";
		} 
		elseif($monthNumber == 06){
			$monthName = "জুন";
		} 
		elseif($monthNumber == 07){
			$monthName = "জুলাই";
		} 
		elseif($monthNumber == "08"){
			$monthName = "আগস্ট";
		} 
		elseif($monthNumber == "09"){
			$monthName = "সেপ্টেম্বর";
		} 
		elseif($monthNumber == 10){
			$monthName = "অক্টোবর";
		} 
		elseif($monthNumber == 11){
			$monthName = "নভেম্বর";
		} 
		elseif($monthNumber == 12){
			$monthName = "ডিসেম্বর";
		}
		return $monthName;
	}