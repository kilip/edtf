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

require 'vendor/autoload.php';

use EDTF\Value\EDTFDateTime as EDTFDateTime;
use EDTF\EDTFParser as EDTFParser;

/*
Some EDTF formatted date-time examples
$dateText = "1985-04";
$dateText = "1985-04-12T21:18:35";
$dateText = "2004-01-01T10:10:10Z";
$dateText = "1985-04-12T21:18:35/2011-07-11T23:51:47+01:32";
$dateText = "1964/2008";
*/

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

$dateText = "1985-04";
echo "===> DATE TEXT:\n$dateText\n";
echo "========\n";
EDTFParser::parseEDTFDate( $dateText );
echo "ONLY DATE:\n";
echo EDTFParser::getOnlyDate();
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
