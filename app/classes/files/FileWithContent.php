<?php

namespace App\Classes\Files;

interface FileWithContent
{

    /**
     * get the content of file
     * @return array|string
     */
    public function content();
}
