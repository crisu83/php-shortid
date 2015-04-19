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