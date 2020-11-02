<?php

namespace EDTF\Value;

final class EDTFDateTime
{

    private $startSecond;    
    private $endSecond;

    private $startMinute;    
    private $endMinute;
	
    private $startHour;    
    private $endHour;	
	
    private $startDay;
    private $endDay;

    private $startMonth;    
    private $endMonth;
    
    private $startYear;    
    private $endYear;
 
	public function __construct(
			string $startSecond, string $endSecond,
			string $startMinute, string $endMinute,
			string $startHour, string $endHour,
			string $startDay, string $endDay,
			string $startMonth, string $endMonth,
			string $startYear, string $endYear) {
		
		$this->startSecond = $startSecond; 
		$this->endSecond   = $endSecond;
		$this->startMinute = $startMinute;
		$this->endMinute   = $endMinute;
		$this->startHour   =  $startHour;
		$this->endHour	   = $endHour;
		$this->startDay    = $startDay;
		$this->endDay	   = $endDay;		
		$this->startMonth  = $startMonth;
		$this->endMonth    = $endMonth;
		$this->startYear   = $startYear;
		$this->endYear 	   = $endYear;
    }
 
 /* TODO: Complete equals method
    public function equals(EDTFDateTime $EDTFDateTime): bool
    {
        return $this->startYear === $EDTFDateTime->startYear
            && $this->endYear === $EDTFDateTime->endYear;
    }
*/
 
	public function getStartSecond(): string
	{
		return $this->startSecond;
	}
 
	public function getEndSecond(): string
	{
		return $this->endSecond;
    }

	public function getStartMinute(): string
	{
		return $this->startMinute;
	}
   
	public function getEndMinute(): string
	{
		return $this->endMinute;
	}

	public function getStartHour(): string
	{
		return $this->startHour;
	}
	
	public function getEndHour(): string
	{
		return $this->endHour;
	}

	public function getStartDay(): string
	{
		return $this->startDay;
	}
   
	public function getEndDay(): string
	{
		return $this->endDay;
	}

	public function getStartMonth(): string
	{
		return $this->startMonth;
	}
   
	public function getEndMonth(): string
	{
		return $this->endMonth;
	}
 
	public function getStartYear(): string {
		return $this->startYear;
	}
 
	public function getEndYear(): string {
		return $this->endYear;
	}
	
	
}