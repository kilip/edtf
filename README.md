# PHP Library Template

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/ProfessionalWiki/EDTF/CI)](https://github.com/ProfessionalWiki/EDTF/actions?query=workflow%3ACI)
[![Type Coverage](https://shepherd.dev/github/ProfessionalWiki/EDTF/coverage.svg)](https://shepherd.dev/github/ProfessionalWiki/EDTF)

This is a template for starting new PHP libraries. Copy or fork to get started quickly.

## Usage

We have a working parser that returns start and end date elements in PHP arrays.

We will add those array elements to corresponding value object elements.

An example for current parser would be:

```php
<?php

require 'EDTFParser.php';
require 'edtf/value/EDTFDateTime.php';

use EDTF\Value\EDTFDateTime as EDTFDateTime;


$dateText = "1985-04-12T21:18:35/2011-07-11T23:51:47+01:32";
//$dateText = "1985-04-12T23:20:30";

echo "DATE TEXT:\n$dateText\n";
echo "========\n";

$arr = EDTFParser::parseDate( $dateText );

if ( EDTFParser::$isItDatePair ) {
	$dateTime = new EDTFDateTime( 
			$arr[0]['second'],	
			$arr[0]['minute'],
			$arr[0]['hour'],
			$arr[0]['daynum'],
			$arr[0]['monthnum'],
			$arr[0]['yearnum']
		);			
	echo "START DATE:\n";
	echo $dateTime;
	echo "========\n";
	$dateTime = new EDTFDateTime( 
			$arr[1]['second'],	
			$arr[1]['minute'],
			$arr[1]['hour'],
			$arr[1]['daynum'],
			$arr[1]['monthnum'],
			$arr[1]['yearnum']
		);
	echo "END DATE:\n";	
	echo $dateTime;	
} else {
	$dateTime = new EDTFDateTime( 
			$arr['second'],	
			$arr['minute'],
			$arr['hour'],
			$arr['daynum'],
			$arr['monthnum'],
			$arr['yearnum']
		);	
	echo $dateTime;		
}
```

## Installation

To use the EDTF library in your project, simply add a dependency on professional-wiki/edtf
to your project's `composer.json` file. Here is a minimal example of a `composer.json`
file that just defines a dependency on UPDATE_NAME 1.x:

```json
{
    "require": {
        "professional-wiki/edtf": "~1.0"
    }
}
```

## Development

Start by installing the project dependencies by executing

    composer update

You can run the tests by executing

    make test
    
You can run the style checks by executing

    make cs
    
To run all CI checks, execute

    make ci
    
You can also invoke PHPUnit directly to pass it arguments, as follows

    vendor/bin/phpunit --filter SomeClassNameOrFilter
