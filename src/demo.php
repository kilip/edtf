<?php

require 'EDTFParser.php';
require 'edtf/value/EDTFDateTime.php';

use EDTF\Value\EDTFDateTime as EDTFDateTime;


$dateText = "1985-04-12T21:18:35/2011-07-11T23:51:47+01:32";
echo "DATE TEXT:\n$dateText\n";
echo "========\n";
EDTFParser::parseEDTFDate( $dateText );
echo "===> START DATE:\n";
echo EDTFParser::getStartDate();
echo "========\n";
echo "END DATE:\n";
echo EDTFParser::getEndDate();

$dateText = "1985-04-12T23:20:30";
echo "===> DATE TEXT:\n$dateText\n";
echo "========\n";
EDTFParser::parseEDTFDate( $dateText );
echo "ONLY DATE:\n";
echo EDTFParser::getOnlyDate();
