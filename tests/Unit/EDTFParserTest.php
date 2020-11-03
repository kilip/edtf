<?php

declare( strict_types = 1 );
namespace Tests\Unit;

use EDTF\EDTFParser as EDTFParser;

use PHPUnit\Framework\TestCase as TestCase;

class EDTFParserTest extends TestCase {

	// Below single test is my first test for demo purposes. It works!
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


	/* EDTF L0 TESTS START */
	
	public function testL0DateComplete() {
		$dateText = "1985-04-12T23:20:30";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(12,	  $obj->getDay() );
		$this->assertEquals(04,	  $obj->getMonth() );
		$this->assertEquals(1985, $obj->getYear() );				
	}

	public function testL0DateMonth() {
		$dateText = "1985-04";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(04,	  $obj->getMonth() );
		$this->assertEquals(1985, $obj->getYear() );				
	}

	public function testL0DateYear() {
		$dateText = "1985";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(1985, $obj->getYear() );				
	}

	public function testL0DateNegativeYear() {
		$dateText = "-1985";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(-1985, $obj->getYear() );				
	}

	public function testL0DateYear0() {
		$dateText = "0000";
		EDTFParser::parseEDTFDate( $dateText );
		$obj = EDTFParser::getOnlyDate();
		
		$this->assertEquals(0000, $obj->getYear() );				
	}
	
	// TODO: Time zone value is zero here, should it be tested in this case?
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

	public function testL0Interval1() {
		/*
		$dateText = "1964/2008";
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
		*/		
	}

/*
	[TestFixture()] public class TestL0Interval {

		[Test] public void TestL0Interval1() {
			const string DateString = "1964/2008";
			var TestDate = Edtf.DatePair.Parse(DateString);
			Assert.AreEqual(1964, TestDate.StartValue.Year.Value);	
			Assert.AreEqual(2008, TestDate.EndValue.Year.Value);
			Assert.AreEqual(DateStatus.Normal, TestDate.StartValue.Status);
			Assert.AreEqual(DateStatus.Normal, TestDate.EndValue.Status);
			Assert.AreEqual(false, TestDate.IsRange);
			Assert.AreEqual(DateString, TestDate.ToString());
		}
*/
	
	/* EDTF L0 TESTS END */
	
}
