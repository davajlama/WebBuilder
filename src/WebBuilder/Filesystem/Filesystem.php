<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 21.03.2018
 * Time: 10:17
 */

namespace Davajlama\WebBuilder\Filesystem;


use Davajlama\WebBuilder\Exception\UnsupportedSourceException;
use Davajlama\WebBuilder\Source\DirectorySource;

class Filesystem
{

    public static function clean()
    {
        return function($source) {

            if(false === $source instanceof DirectorySource) {
                throw new UnsupportedSourceException();
            }

            $directoryIterator  = new \RecursiveDirectoryIterator($source->getPath(), \RecursiveDirectoryIterator::SKIP_DOTS);
            $iterator           = new \RecursiveIteratorIterator($directoryIterator, \RecursiveIteratorIterator::SELF_FIRST);

            $directories = [];
            foreach ($iterator as $item) {
                if($item->isDir()) {
                    $directories[] = $item->getPathname();
                } else {
                    unlink($item->getPathname());
                }
            }

            foreach($directories as $dir) {
                rmdir($dir);
            }

            return $source;
        };
    }

    public static function copy($destination)
    {
        return function($source) use($destination) {

            if(false === $source instanceof DirectorySource) {
                throw new UnsupportedSourceException();
            }

            if(!is_dir($destination)) {
                if(!mkdir($destination)) {
                    throw new \Exception("Make directory [$destination] failed.");
                }
            }

            $directoryIterator  = new \RecursiveDirectoryIterator($source->getPath(), \RecursiveDirectoryIterator::SKIP_DOTS);
            $iterator           = new \RecursiveIteratorIterator($directoryIterator, \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($iterator as $item) {
                if($item->isDir()) {
                    $pth = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

                    if(!is_dir($pth)) {
                        mkdir($pth);
                    }

                } else {
                    copy($item, $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
                }
            }

        };

    }

}