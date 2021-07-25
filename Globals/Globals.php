<?php

namespace Globals;


class Globals
{


    private array $folders;
    private array $files;
    private array $extensions;


    /**
     * Globals constructor.
     * @param $folders
     * @param $files
     * @param $extensions
     */
    public function __construct($folders, $files, $extensions)
    {
        $this->folders = $folders;
        $this->files = $files;
        $this->extensions = $extensions;
    }


    /**
     * Autoload files
     */
    public function autoload()
    {
        foreach ($this->folders as $folder) {
            foreach ($this->files as $fileName) {
                foreach ($this->extensions as $extension) {
                    if ($folder == '') {
                        $path = $folder . $fileName . $extension;
                    } else {
                        $path = $folder . DIRECTORY_SEPARATOR . $fileName . $extension;
                    }
                    if (is_readable($path)) {

                        include_once($path);
                    }
                }
            }
        }
    }

}