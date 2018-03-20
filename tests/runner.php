<?php

require_once __DIR__ . '/../src/WebBuilder.php';
require_once __DIR__ . '/../src/SourceInterface.php';
require_once __DIR__ . '/../src/Builder.php';
require_once __DIR__ . '/../src/Carriage.php';
require_once __DIR__ . '/../src/Sources/FileSource.php';
require_once __DIR__ . '/../src/Sources/DirectorySource.php';



$builder = new \Davajlama\WebBuilder\WebBuilder();
$builder->source(__DIR__)->build(function(){
    
});
        

$builder->source(__DIR__ . '/Fixtures/empty.txt')->pipe(function(\Davajlama\WebBuilder\SourceInterface $src){
//    var_dump($src);
    
    return $src;
})->build(function($src){
    var_dump("builduji");
  
    $this->source($src)
            ->pipe(function($src){
                var_dump("nová akce");
                var_dump($src);
                return $src;
            });
  
});

$builder['less']->source(__DIR__ . '/Fixtures/empty.txt')->build(function($src){
    var_dump($src, "less");
    return $src;
});

$builder['less']['compile']->source(__DIR__ . '/Fixtures/empty.txt')->build(function($src){
    var_dump($src, "less:compile");
    return $src;
});

$builder['less']['compile']['admin']->source(__DIR__ . '/Fixtures/empty.txt')->build(function($src){
    var_dump($src, "less:compile:admin");
    return $src;
});

$builder->build();
//$webhelp->build('less');
//$webhelp->build('less:compile');
//$webhelp->build('less:compile:admin');



