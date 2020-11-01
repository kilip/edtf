<?php

class EDTFDateTime
{

	public
	$regexPattern = "/(?x) # Turns on free spacing mode for easier readability					
					
					# Year start
						(?<year>					
							(?<yearnum>[+-]?(?:\d+e\d+|[0-9u][0-9ux]*))
							(?>S # Literal S letter. It is for the significant digit indicator
							(?<yearprecision>\d+))?
							(?<yearend>\)?[~?]{0,2})
						)
					# Year end
					
					(?>- # Literal - (hyphen)
					
					# Month start										
						(?<month>						
							(?<monthopenparens>\(+)?							
							(?<monthnum>
								(?>1[0-9u]|[0u][0-9u]|2[1-4])
							)								
							(?>\^							
								(?<seasonqualifier>[\P{L}\P{N}\P{M}:.-]+)
							)?								
						)
												
						(?<monthend>(?:\)?[~?]{0,2}){0,2})						
					# Month end
					
					(?>- # Literal - (hyphen)
					
					# Day start
						(?<day>
						(?<dayopenparens>\(+)?
						(?<daynum>(?>[012u][0-9u]|3[01u])))
						(?<dayend>[)~?]*)(?>T
					# Day end
					
					# Others start #					
						(?<hour>2[0-3]|[01][0-9]):					
						(?<minute>[0-5][0-9]):					
						(?<second>[0-5][0-9])(?>					
						(?<tzutc>Z)|					
						(?<tzsign>[+-])					
						(?<tzhour>[01][0-9]):					
						(?<tzminute>[0-5][0-9]))?)?)?)?$
					# Others end #
					/";

	public $dateArr;
	public $startDateArr;
	public $endDateArr;
	public $isItDatePair = FALSE; /* It is TRUE if there is both start and end date */
	
	
	/* TODO: Make the class constructor able to get zero or more parameters
	public function __construct() {
		$parameters = func_get_args();
		...
	}
	*/
	

	public function __construct($dateStr) {		
		
		$this->dateArr = $this->parseDate($dateStr);
		
		if ( sizeof($this->dateArr) > 1)
			$this->isItDatePair = TRUE;
		if ( !$this->isItDatePair ) {
			$this->startDateArr = $this->dateArr[0];
		} else if ( $this->isItDatePair ) {
			$this->startDateArr = $this->dateArr[0];
			$this->endDateArr   = $this->dateArr[1];
		}
	}

	public function parseDate($dateStr) {

		$splitArr = preg_split("/\//", $dateStr);
		
		if ( sizeof( $splitArr ) == 1 ) {
			preg_match( $regexPattern, $splitArr[0], $dateArr );
			return $dateArr;
		} else if ( sizeof($splitArr) > 1 ) {
			preg_match( $this->regexPattern, $splitArr[0], $startDateArr );
			preg_match( $this->regexPattern, $splitArr[1], $endDateArr );
			return array( $startDateArr, $endDateArr );
		}
		return NULL;
	}
						
}