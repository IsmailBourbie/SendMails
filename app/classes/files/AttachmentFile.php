<?php

namespace App\Classes\Files;
use App\Classes\File;

class AttachmentFile extends File {
    /**
     * the authorized extensions of this files
     * @var array validExtensions
     */
    const VALID_EXTENSIONS = ['pdf', 'txt', 'docs', 'doc'];


    /**
     * Override the constructor to set validExtensions
     */
    public function __construct($file)
    {
        parent::__construct($file);
        $this->validExtension = self::VALID_EXTENSIONS;
    }
    
}

