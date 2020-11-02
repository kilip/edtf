<?php

require 'EDTFParser.php';
require 'edtf/value/EDTFDateTime.php';

use EDTF\Value\EDTFDateTime as EDTFDateTime;


$dateText = "1985-04-12T21:18:35/2011-07-11T23:51:47+01:32";
//$dateText = "1985-04-12T23:20:30";

$arr = EDTFParser::parseDate( $dateText );
if ( EDTFParser::$isItDatePair ) {
	//$dateTime = new EDTFDateTime( $arr[0]['year'], $arr[1]['year'] );
	$dateTime = new EDTFDateTime( 
			$arr[0]['second'], $arr[1]['second'],
			$arr[0]['minute'], $arr[1]['minute'],
			$arr[0]['hour'], $arr[1]['hour'],
			$arr[0]['day'], $arr[1]['day'],
			$arr[0]['month'], $arr[1]['month'],
			$arr[0]['year'], $arr[1]['year']		
		);
}

echo "Test Date-Time Text:\n";
echo $dateText;
echo "\n\n";

echo $dateTime->getStartSecond();
echo " | ";
echo $dateTime->getEndSecond();

echo "\n========================\n";

echo $dateTime->getStartMinute();
echo " | ";
echo $dateTime->getEndMinute();

echo "\n========================\n";

echo $dateTime->getStartHour();
echo " | ";
echo $dateTime->getEndHour();

echo "\n========================\n";

echo $dateTime->getStartDay();
echo " | ";
echo $dateTime->getEndDay();

echo "\n========================\n";

echo $dateTime->getStartMonth();
echo " | ";
echo $dateTime->getEndMonth();

echo "\n========================\n";

echo $dateTime->getStartYear();
echo " | ";
echo $dateTime->getEndYear();

