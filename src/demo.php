<?php

require 'EDTFParser.php';
require 'edtf/value/EDTFDateTime.php';

use EDTF\Value\EDTFDateTime as EDTFDateTime;


$dateText = "1985-04-12T21:18:35/2011-07-11T23:51:47+01:32";
//$dateText = "1985-04-12T23:20:30";

echo "DATE TEXT:\n$dateText\n";
echo "========\n";

$arr = EDTFParser::parseDate( $dateText );

if ( EDTFParser::$isItDatePair ) {
	$dateTime = new EDTFDateTime( 
			$arr[0]['second'],	
			$arr[0]['minute'],
			$arr[0]['hour'],
			$arr[0]['daynum'],
			$arr[0]['monthnum'],
			$arr[0]['yearnum']
		);			
	echo "START DATE:\n";
	echo $dateTime;
	echo "========\n";
	$dateTime = new EDTFDateTime( 
			$arr[1]['second'],	
			$arr[1]['minute'],
			$arr[1]['hour'],
			$arr[1]['daynum'],
			$arr[1]['monthnum'],
			$arr[1]['yearnum']
		);
	echo "END DATE:\n";	
	echo $dateTime;	
} else {
	$dateTime = new EDTFDateTime( 
			$arr['second'],	
			$arr['minute'],
			$arr['hour'],
			$arr['daynum'],
			$arr['monthnum'],
			$arr['yearnum']
		);	
	echo $dateTime;		
}