<?php

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Davajlama\WebBuilder\WebBuilder();
$builder->source(__DIR__)->build(function(){

});

$builder->build();