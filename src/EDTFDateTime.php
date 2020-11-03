<?php

namespace EDTF;

final class EDTFDateTime
{
	
	private $tzutc;
	private $tzminute;
	private $tzhour;
    private $second;
    private $minute;
    private $hour;
    private $day;
    private $month;
    private $year;
 
	public function __construct(
		string $tzutc,
		string $tzminute,
		string $tzhour,
		string $second,
		string $minute,
		string $hour,
		string $day,
		string $month,
		string $year)
	{		
		$this->tzutc    = $tzutc;
		$this->tzminute = $tzminute;
		$this->tzhour   = $tzhour;
		$this->second   = $second;
		$this->minute   = $minute;	
		$this->hour     = $hour;	
		$this->day      = $day;
		$this->month    = $month;
		$this->year     = $year;	
    }
  	
	public function getTzutc(): string { return $this->tzutc;}
	public function getTzminute(): string { return $this->tzminute;}
	public function getTzhour(): string { return $this->tzhour;}
	public function getSecond(): string { return $this->second;}
	public function getMinute(): string {return $this->minute;}
	public function getHour(): string {return $this->hour;}
	public function getDay(): string {return $this->day;}
	public function getMonth(): string {return $this->month;}
	public function getYear(): string {return $this->year;}
	
	public function __toString() {
		return			
			"TZUTC:" . $this->tzutc . "\n" .
			"TZMinute:" . $this->tzminute . "\n" .
			"TZHour:"   . $this->tzhour . "\n" .
			"Second:"   . $this->second . "\n" .
			"Minute:"   . $this->minute . "\n" .
			"Hour:"     . $this->hour . "\n" .
			"Day:"      . $this->day . "\n" .
			"Month:"    . $this->month . "\n" .
			"Year:"     . $this->year . "\n"
			;
	}

/* TODO: Complete equals method
    public function equals(EDTFDateTime $EDTFDateTime): bool
    {
        return $this->startYear === $EDTFDateTime->startYear
            && $this->endYear === $EDTFDateTime->endYear;
    }
*/

}