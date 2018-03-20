<?php

var_dump("david");


$builder = new WebHelp();

$builder->src()->watch(function($src){
	$this->src(__DIR__ . '/src')
		->pipe(File::filter('~/\w+Bundle/src/resources/less/.*\.less~'))
		->work(function($src){
		
			$this->retry();
		});

$bundlesLess = $this->src()->watch(function($src){
	$src->pipe();

});
		
});

$builder->src(__DIR__ . '/src')
		->pipe(Filter::regexp('~*Bundle/resources/less~'))
		->worker(function($src){
			$this->interval(5000);
			$src->pipe();
		});
		

interface Source
{
	public function check();
}
		

// toto asi zat�m ne

class Worker
{
	private $source;
	
	private $callback;
	
	private $interval;
	
	public function check();
	
	public function invoke();
	
	public function interval();
}

// watch
foreach($workers as $worker) {
	$worker->check() && $worker->invoke();
}

$source->isModified();



$builder['less']['admin']->src()->watch();
$builder['less']['front']->src()->watch();
$builder->watch();
$builder->build();

// webhelp watch|build <task>
// webhelp watch 
// webhelp watch less
// webhelp watch less:admin
// webhelp build
// webhelp build less
// webhelp build less:admin
