<?php

namespace App\Classes\Files;

use App\Classes\File;

class ImageFile extends File
{
    /**
     * the authorized extensions of this files
     * @var array validExtensions
     */
    const VALID_EXTENSIONS = ['png', 'jpeg', 'jpg', 'gif'];


    /**
     * Override the constructor to set validExtensions
     */
    public function __construct($file)
    {
        parent::__construct($file);
        $this->validExtension = self::VALID_EXTENSIONS;
    }
}
