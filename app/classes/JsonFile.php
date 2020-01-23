<?php

namespace App\Classes;

class JsonFile extends File {
    /**
     * the authorized extensions of this files
     * @var array validExetensions
     */
    const VALID_EXETENSIONS = ["json"];

    /**
     * overrated isValid method
     * @return bool  
     */
    public function isValid()
    {
        return in_array($this->extension, self::VALID_EXETENSIONS);
    }

    /**
     * overrated content method
     * @return array
     */
    public function content()
    {
        return [];
    }
}