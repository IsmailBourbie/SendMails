<?php

namespace App\Classes\Files;

use App\Classes\File;

class HtmlFile extends File implements FileWithContent
{
    /**
     * the authorized extensions of this files
     * @var array validExtensions
     */
    const VALID_EXTENSIONS = ['htm', 'html'];


    /**
     * Override the constructor to set validExtensions
     */
    public function __construct($file)
    {
        parent::__construct($file);
        $this->validExtension = self::VALID_EXTENSIONS;
    }

    /**
     * overrated content method
     * @return array
     */
    public function content()
    {
        return file_get_contents($this->filepath);
    }
}
