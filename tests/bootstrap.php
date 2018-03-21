<?php

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Davajlama\WebBuilder\WebBuilder();
$builder->source(__DIR__ . '/Fixtures/css')->build(function($src){
    /** @var $this \Davajlama\WebBuilder\WebBuilder */
    $this->source($destination = __DIR__ . '/Fixtures/public/css')
            ->pipe(\Davajlama\WebBuilder\Filesystem\Filesystem::clean());

    $this->source($src)
            ->pipe(\Davajlama\WebBuilder\Filesystem\Filesystem::copy($destination));
});



$builder->build();