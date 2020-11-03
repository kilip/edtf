<?php

declare( strict_types = 1 );
namespace Tests\Unit;

use EDTF\EDTFParser as EDTFParser;

use PHPUnit\Framework\TestCase as TestCase;

class EDTFParserTest extends TestCase {

	/**
	 * Below single test is my first test for demo purposes. It works!
     * @covers EDTFParser::getOnlyDate for a full date-time
     */	
	public function testFullDateAndTime() {	
		$dateText = "1985-04-12T23:20:30";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		$this->assertEquals(30,	  $obj->getSecond() );		
		$this->assertEquals(20,	  $obj->getMinute() );
		$this->assertEquals(23,	  $obj->getHour() );
		$this->assertEquals(12,	  $obj->getDay() );
		$this->assertEquals(04,	  $obj->getMonth() );
		$this->assertEquals(1985, $obj->getYear() );
	}

	/*===============EDTF L0 TESTS START===============*/
	
	/**
     * @covers EDTFParser::getOnlyDate for a full date-time
     */		
	public function testL0DateComplete() {
		$dateText = "1985-04-12T23:20:30";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals(12,	  $obj->getDay() );
		$this->assertEquals(04,	  $obj->getMonth() );
		$this->assertEquals(1985, $obj->getYear() );				
	}

	/**
     * @covers EDTFParser::getOnlyDate for year-month
     */
	public function testL0DateMonth() {
		$dateText = "1985-04";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals(04,	  $obj->getMonth() );
		$this->assertEquals(1985, $obj->getYear() );				
	}

	/**
     * @covers EDTFParser::getOnlyDate for year
     */
	public function testL0DateYear() {
		$dateText = "1985";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals(1985, $obj->getYear() );				
	}

	/**
     * @covers EDTFParser::getOnlyDate for negative year
     */
	public function testL0DateNegativeYear() {
		$dateText = "-1985";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals(-1985, $obj->getYear() );				
	}

	/**
     * @covers EDTFParser::getOnlyDate for zero year
     */
	public function testL0DateYear0() {
		$dateText = "0000";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals(0000, $obj->getYear() );				
	}
	
	/**
	 * TODO: Time zone value is zero here, should it be tested in this case?
     * @covers EDTFParser::getOnlyDate for 
     */	
	public function testL0DateTime1() {
		$dateText = "2013-02-03T09:30:01";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals(01,	  $obj->getSecond() );		
		$this->assertEquals(30,	  $obj->getMinute() );
		$this->assertEquals(9,	  $obj->getHour() );
		$this->assertEquals(3,	  $obj->getDay() );
		$this->assertEquals(2,	  $obj->getMonth() );
		$this->assertEquals(2013, $obj->getYear() );
	}	

	/**
     * @covers EDTFParser::getOnlyDate for date-time ending with Z letter for UTC timezone
     */
	public function testL0DateTime2() {
		$dateText = "2004-01-01T10:10:10Z";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals('Z',  $obj->getTzutc() );
		$this->assertEquals(10,	  $obj->getSecond() );		
		$this->assertEquals(10,	  $obj->getMinute() );
		$this->assertEquals(10,	  $obj->getHour() );
		$this->assertEquals(1,	  $obj->getDay() );
		$this->assertEquals(1,	  $obj->getMonth() );
		$this->assertEquals(2004, $obj->getYear() );
	}	

	/**
     * @covers EDTFParser::getOnlyDate for date-time with UTC + some hours
     */
	public function testL0DateTime3() {
		$dateText = "2004-01-01T10:10:10+05:13";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();		
		$this->assertEquals(13,   $obj->getTzminute() );
		$this->assertEquals(5,    $obj->getTzhour() );
		$this->assertEquals(10,	  $obj->getSecond() );		
		$this->assertEquals(10,	  $obj->getMinute() );
		$this->assertEquals(10,	  $obj->getHour() );
		$this->assertEquals(1,	  $obj->getDay() );
		$this->assertEquals(1,	  $obj->getMonth() );
		$this->assertEquals(2004, $obj->getYear() );
	}

	/**
     * @covers EDTFParser::getStartDate and EDTFParser::getEndDate for year/year
     */
	public function testL0Interval1() {		
		$dateText = "1964/2008";
		EDTFParser::parseEDTFDate( $dateText );
		$startDate = EDTFParser::getStartDate();
		$endDate = EDTFParser::getEndDate();		
		$this->assertEquals(1964, $startDate->getYear() );
		$this->assertEquals(2008, $endDate->getYear() );		
	}

	/**
     * @covers EDTFParser::getStartDate and EDTFParser::getEndDate for year-month/year-month
     */
	public function testL0Interval2() {		
		$dateText = "2004-06/2006-08";
		EDTFParser::parseEDTFDate( $dateText );
		$startDate = EDTFParser::getStartDate();
		$endDate = EDTFParser::getEndDate();		
		$this->assertEquals(2004, $startDate->getYear() );
		$this->assertEquals(6,	  $startDate->getMonth() );
		$this->assertEquals(2006, $endDate->getYear() );
		$this->assertEquals(8,	  $endDate->getMonth() );		
	}

	/**
     * @covers EDTFParser::getStartDate and EDTFParser::getEndDate for year-month-day/year-month-day
     */
	public function testL0Interval3() {
		$dateText = "2004-02-01/2005-02-08";
		EDTFParser::parseEDTFDate( $dateText );
		$startDate = EDTFParser::getStartDate();
		$endDate = EDTFParser::getEndDate();	
		$this->assertEquals(2004, $startDate->getYear() );
		$this->assertEquals(2,	  $startDate->getMonth() );
		$this->assertEquals(1,	  $startDate->getDay() );
		$this->assertEquals(2005, $endDate->getYear() );
		$this->assertEquals(2,	  $endDate->getMonth() );
		$this->assertEquals(8,	  $endDate->getDay() );
	}

	/**
     * @covers EDTFParser::getStartDate and EDTFParser::getEndDate for year-month-day/year-month
     */
	public function testL0Interval4() {
		$dateText = "2004-02-01/2005-02";
		EDTFParser::parseEDTFDate( $dateText );
		$startDate = EDTFParser::getStartDate();
		$endDate = EDTFParser::getEndDate();	
		$this->assertEquals(2004, $startDate->getYear() );
		$this->assertEquals(2,	  $startDate->getMonth() );
		$this->assertEquals(1,	  $startDate->getDay() );
		$this->assertEquals(2005, $endDate->getYear() );
		$this->assertEquals(2,	  $endDate->getMonth() );
	}

	/**
     * @covers EDTFParser::getStartDate and EDTFParser::getEndDate for year-month-day/year
     */
	public function testL0Interval5() {
		$dateText = "2004-02-01/2005";
		EDTFParser::parseEDTFDate( $dateText );
		$startDate = EDTFParser::getStartDate();
		$endDate = EDTFParser::getEndDate();	
		$this->assertEquals(2004, $startDate->getYear() );
		$this->assertEquals(2,	  $startDate->getMonth() );
		$this->assertEquals(1,	  $startDate->getDay() );
		$this->assertEquals(2005, $endDate->getYear() );
	}

	/**
     * @covers EDTFParser::getStartDate and EDTFParser::getEndDate for year/year-month
     */
	public function testL0Interval6() {
		$dateText = "2005/2006-02";
		EDTFParser::parseEDTFDate( $dateText );
		$startDate = EDTFParser::getStartDate();
		$endDate = EDTFParser::getEndDate();	
		$this->assertEquals(2005, $startDate->getYear() );
		$this->assertEquals(2,	  $endDate->getMonth() );
		$this->assertEquals(2006, $endDate->getYear() );
	}	
	
	/*===============EDTF L0 TESTS END===============*/
	
}
