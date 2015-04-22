# php-shortid

[![Build Status](https://travis-ci.org/crisu83/php-shortid.svg?branch=master)](https://travis-ci.org/crisu83/php-shortid)
[![Code Climate](https://codeclimate.com/github/crisu83/php-shortid/badges/gpa.svg)](https://codeclimate.com/github/crisu83/php-shortid)
[![Total Downloads](https://poser.pugx.org/crisu83/shortid/downloads)](https://packagist.org/packages/crisu83/shortid) [![Latest Unstable Version](https://poser.pugx.org/crisu83/shortid/v/unstable.svg)](https://packagist.org/packages/crisu83/shortid) [![License](https://poser.pugx.org/crisu83/shortid/license.svg)](https://packagist.org/packages/crisu83/shortid)

Library for generating short non-sequential unique identifiers in PHP.

## Why do I want this?

This library was created as a more convenient alternative to other unique identifer generators such as UUID. 
While the identifiers generated may not be truly unique, they are more convenient because of their short form
and unique enough to be used as e.g. entity ids, database identifiers, url-shorteners and much more.

## Disclaimer

Please note that if your project requires the identifiers to be truly unique you should verify the uniqueness yourself.
This is by design to both increase the performance and reduce the memory consumption when generating identifiers.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist crisu83/shortid "*"
```

or add

```
"crisu83/shortid": "*"
```

to the require section of your `composer.json` file.

## Usage

Example usage:

```php
<?php

use Crisu83\ShortId\ShortId;

require(__DIR__ . '/../vendor/autoload.php');

$shortid = ShortId::create();

echo $shortid->generate() . "\n";
echo $shortid->generate() . "\n";
echo $shortid->generate() . "\n";
echo $shortid->generate() . "\n";
echo $shortid->generate() . "\n";
echo $shortid->generate() . "\n";
echo $shortid->generate() . "\n";
echo $shortid->generate() . "\n";
echo $shortid->generate();
```

Sample output:

```
$ php examples/examples.php
mGRdss0
cQEhtSm
WAOsF0B
Wxo-6hC
njJM-67
ySojqwP
yz03QdC
baDvRWZ
```
