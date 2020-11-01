# PHP Library Template

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/ProfessionalWiki/EDTF/CI)](https://github.com/ProfessionalWiki/EDTF/actions?query=workflow%3ACI)
[![Type Coverage](https://shepherd.dev/github/ProfessionalWiki/EDTF/coverage.svg)](https://shepherd.dev/github/ProfessionalWiki/EDTF)

This is a template for starting new PHP libraries. Copy or fork to get started quickly.

## Usage

We have a working parser that returns start and end date elements in PHP arrays.

We will add those array elements to corresponding value object elements.

An example for current parser would be:

```php
$dateText = "1985-04-12T23:20:30/2011-01-12T23:19:35+01:32";

$myEDTFParser = new EDTFDateTime($dateText);

print_r( $myEDTFParser->startDateArr );

print_r( $myEDTFParser->endDateArr );
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
