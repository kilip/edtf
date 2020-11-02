<?php

declare( strict_types = 1 );
namespace Tests\Unit;

use EDTF\EDTFParser as EDTFParser;

use PHPUnit\Framework\TestCase as TestCase;

class EDTFParserTest extends TestCase {

	public function testFullDateAndTime() {	
		$dateText = "1985-04-12T23:20:30";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(30,		$obj->getSecond() );		
		$this->assertEquals(20,		$obj->getMinute() );
		$this->assertEquals(23,		$obj->getHour() );
		$this->assertEquals(12,		$obj->getDay() );
		$this->assertEquals(04,		$obj->getMonth() );
		$this->assertEquals(1985,	$obj->getYear() );
	}
	
	
	public function testL0DateComplete() {
		$dateText = "1985-04-12T23:20:30";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(12,		$obj->getDay() );
		$this->assertEquals(04,		$obj->getMonth() );
		$this->assertEquals(1985,	$obj->getYear() );				
	}

	public function testL0DateMonth() {
		$dateText = "1985-04";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(04,		$obj->getMonth() );
		$this->assertEquals(1985,	$obj->getYear() );				
	}

	public function testL0DateYear() {
		$dateText = "1985";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(1985,	$obj->getYear() );				
	}

	public function testL0DateNegativeYear() {
		$dateText = "-1985";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(-1985,	$obj->getYear() );				
	}

	public function testL0DateYear0() {
		$dateText = "0000";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(0000,	$obj->getYear() );				
	}

	
}
