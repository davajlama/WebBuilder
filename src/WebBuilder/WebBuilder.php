<?php

namespace Davajlama\WebBuilder;
use Davajlama\WebBuilder\Source\DirectorySource;

/**
 * @author David Bittner
 */
class WebBuilder implements \ArrayAccess
{
    
    /** @var self[] */
    private $tree = [];
    
    /** @var Builder[] */
    private $builders = [];

    public function build($group = null)
    {
        if($group === null) {
            foreach($this->builders as $builder) {
                $builder->build($this);
            }
            
            foreach($this->tree as $builder) {
                $builder->build();
            }
        } else {
            $parts  = explode(':', $group, 2);
            $key    = $parts[0];
            $param  = isset($parts[1]) ? $parts[1] : null;
            
            if($this->offsetExists($key)) {
                $this[$key]->build($param);
            }
        }
    }

    /**
     * @param mixed $source
     * @return Carriage
     */
    public function source($source)
    {
        if(is_string($source) && is_dir($source)) {
            return new Carriage($this, new DirectorySource($source));
        }

        return new Carriage($this, $source);
    }
    
    /**
     * @param \Davajlama\WebBuilder\Builder $builder
     * @return \Davajlama\WebBuilder\WebBuilder
     */
    public function addBuilder(Builder $builder)
    {
        $this->builders[] = $builder;
        return $this;
    }
    
    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->tree);
    }

    /**
     * @param string $offset
     * @return self
     */
    public function offsetGet($offset)
    {
        if($this->offsetExists($offset)) {
            return $this->tree[$offset];
        }
        
        return $this->tree[$offset] = new self();
    }

    /**
     * @param string $offset
     * @param self $value
     */
    public function offsetSet($offset, $value)
    {
        if(false === $value instanceof self) {
            throw new Exception("Value must be instance of " . self::class);
        }
        
        $this->tree[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->tree[$offset]);
    }
    
}
