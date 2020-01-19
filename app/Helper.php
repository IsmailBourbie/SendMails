<?php


class Helper {




    public static function validFile($file) {
        $valid_extenssions = ['pdf', 'doc', 'docx', 'txt', 'json'];

        if(file_exists($file)) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if(in_array($ext, $valid_extenssions)) {
                return true;
            }
        }
        return false;
    }
}