<?php

namespace App\Classes\Files;

use App\Classes\File;

class JsonFile extends File implements FileWithContent
{
    /**
     * the authorized extensions of this files
     * @var array validExtensions
     */
    const VALID_EXTENSIONS = ["json"];


    /**
     * Override the constructor to set validExtensions
     */
    public function __construct($file)
    {
        parent::__construct($file);
        $this->validExtension = self::VALID_EXTENSIONS;
    }

    /**
     * override content method from FileWithContent interface
     * @return array
     */
    public function content()
    {
        return json_decode(file_get_contents($this->filepath), true);
    }
}
