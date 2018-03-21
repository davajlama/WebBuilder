<?php

namespace Davajlama\WebBuilder;

/**
 * @author David
 */
class Carriage
{
    /** @var WebBuilder */
    private $builder;
    
    /** @var mixed */
    private $source;

    /**
     * Carriage constructor.
     * @param WebBuilder $webhelp
     * @param mixed $source
     */
    public function __construct(WebBuilder $webhelp, $source)
    {
        $this->builder  = $webhelp;
        $this->source   = $source;
    }

    public function build(\Closure $callback)
    {
        $this->builder->addBuilder(new Builder($this->source, $callback));
    }

    /**
     * @param callable $callback
     * @return Carriage
     */
    public function pipe(callable $callback)
    {
        return new self($this->builder, $callback($this->source));
    }
    
}
