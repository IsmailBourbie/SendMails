<?php

namespace App\Classes\Files;
use App\Classes\File;
class JsonFile extends File {
    /**
     * the authorized extensions of this files
     * @var array validExtensions
     */
    const VALID_EXTENSIONS = ["json"];

    /**
     * overrated isValid method
     * @return bool  
     */
    public function isValid()
    {
        return in_array($this->extension, self::VALID_EXTENSIONS);
    }

    /**
     * overrated content method
     * @return array
     */
    public function content()
    {
        $path = 'workspace/' . $this->dirname . '/' . $this->basename;
        return json_decode(file_get_contents($path), true);
    }
}