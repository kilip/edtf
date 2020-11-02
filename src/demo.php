<?php

require 'EDTFParser.php';
require 'edtf/value/EDTFDateTime.php';

use EDTF\Value\EDTFDateTime as EDTFDateTime;


$dateText = "1985-04-12T21:18:35/2011-07-11T23:51:47+01:32";
//$dateText = "1985-04-12T23:20:30";

echo "DATE TEXT:\n$dateText\n";
echo "========\n";

//print_r( EDTFParser::parseEDTFDate( $dateText ) );
EDTFParser::parseEDTFDate( $dateText );


echo "START DATE:\n";
echo EDTFParser::getStartDate();

echo "========\n";
echo "END DATE:\n";
echo EDTFParser::getEndDate();

echo "========\n";
echo "ONLY DATE:\n";
echo EDTFParser::getOnlyDate();