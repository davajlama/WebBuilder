<?php

namespace Davajlama\WebBuilder;

/**
 * @author David
 */
class Builder
{
    /** @var mixed */
    private $source;
    
    /** @var \Closure */
    private $callback;

    /**
     * Builder constructor.
     * @param mixed $source
     * @param \Closure $callback
     */
    public function __construct($source, \Closure $callback)
    {
        $this->source   = $source;
        $this->callback = $callback;
    }

    public function build(WebBuilder $builder)
    {
        $cb = $this->callback->bindTo($builder);
        $cb($this->getSource());
    }
    
    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }
}
