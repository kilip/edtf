<?php

namespace EDTF\Value;

final class EDTFDateTime
{
    
    private $startYear;    
    private $endYear;
 
    public function __construct(string $startYear, string $endYear)
    {
        $this->startYear = $startYear;
        $this->endYear = $endYear;
    }
 
    public function equals(EDTFDateTime $EDTFDateTime): bool
    {
        return $this->startYear === $EDTFDateTime->startYear
            && $this->endYear === $EDTFDateTime->endYear;
    }
 
    public function getStartYear(): string
    {
        return $this->startYear;
    }
 
    public function getEndYear(): string
    {
        return $this->endYear;
    }
	
	
}