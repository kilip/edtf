<?php

class EDTFParser
{
	
	public static string
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
	
	public static bool $isItDatePair = FALSE;
	
	public static function parseDate(string $dateStr): array
	{	
		$splitArr = preg_split("/\//", $dateStr);
		
		if ( sizeof( $splitArr ) == 1 ) {			
			preg_match( static::$regexPattern, $splitArr[0], $singleDateArr );
			return $singleDateArr;
		} else if ( sizeof($splitArr) > 1 ) {
			preg_match( static::$regexPattern, $splitArr[0], $startDateArr );
			preg_match( static::$regexPattern, $splitArr[1], $endDateArr );									
			static::$isItDatePair = TRUE;
			return array( $startDateArr , $endDateArr);						
		}

		return array();
	}
	
}