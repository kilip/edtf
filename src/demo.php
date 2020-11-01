<?php

require 'EDTFParser.php';
require 'edtf/value/EDTFDateTime.php';

use EDTF\Value\EDTFDateTime as EDTFDateTime;


$dateText = "1985-04-12T23:20:30/2011-01-12T23:19:35+01:32";
//$dateText = "1985-04-12T23:20:30";

$arr = EDTFParser::parseDate( $dateText );
if ( EDTFParser::$isItDatePair ) {
	$dateTime = new EDTFDateTime( $arr[0]['year'], $arr[1]['year'] );
}

echo $dateTime->getStartYear();
echo "\n====\n";
echo $dateTime->getEndYear();

