<?php

namespace Davajlama\WebBuilder;

/**
 * @author David
 */
class Carriage
{
    /** @var WebBuilder */
    private $webhelp;
    
    /** @var SourceInterface */
    private $source;
    
    /**
     * @param \Davajlama\WebHelp\WebBuilder $webhelp
     * @param \Davajlama\WebHelp\SourceInterface $source
     */
    public function __construct(WebBuilder $webhelp, SourceInterface $source)
    {
        $this->webhelp  = $webhelp;
        $this->source   = $source;
    }

    public function build(\Closure $callback)
    {
        $this->webhelp->addBuilder(new \Davajlama\WebBuilder\Builder($this->source, $callback));
    }
    
    /**
     * @param \Davajlama\WebHelp\callable $callback
     * @return self
     */
    public function pipe(callable $callback)
    {
        return new self($this->webhelp, $callback($this->source));
    }
    
}
