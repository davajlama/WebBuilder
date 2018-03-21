<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 21.03.2018
 * Time: 10:25
 */

namespace Davajlama\WebBuilder\Source;


class DirectorySource
{

    /** @var string */
    private $path;

    /**
     * DirectorySource constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

}