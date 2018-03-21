<?php

namespace Davajlama\WebBuilder;

/**
 * @author David
 */
class Builder
{
    /** @var \Davajlama\WebHelp\SourceInterface */
    private $source;
    
    /** @var \Closure */
    private $callback;

    /**
     * @param \Davajlama\WebHelp\SourceInterface $source
     * @param \Closure $callback
     */
    public function __construct(\Davajlama\WebBuilder\SourceInterface $source, \Closure $callback)
    {
        $this->source = $source;
        $this->callback = $callback;
    }
    
    public function build(WebBuilder $builder)
    {
        $cb = $this->callback->bindTo($builder);
        $cb($this->getSource());
    }
    
    /**
     * @return SourceInterface
     */
    public function getSource()
    {
        return $this->source;
    }
}
