<?php

namespace App\Classes;

abstract class File {
    
        /**
         * dirname of file
         * @var string $dirname
         * @access protected
         */
        protected $dirname = NULL;
    
        /**
         * filename of file
         * @var string $filename
         * @access protected
         */
        protected $filename = NULL;
    
        /**
         * basename of file
         * @var string $basename
         * @access protected
         */
        protected $basename = NULL;

        /**
         * extension of file
         * @var string $extension
         * @access protected
         */
        protected $extension = NULL;
    

        public function __construct($file)
        {
            $path = 'workspace/'. $file;
            if($this->isExists($path))
            {
                $file_parts = pathinfo($file);
                $this->dirname = $file_parts['dirname'];
                $this->basename = $file_parts['basename'];
                $this->filename = $file_parts['filename'];
                $this->extension = $file_parts['extension'];
            }
        }


        /**
         * check file if exists
         * @param $path
         * @return bool
         */
        public function isExists($path)
        {
            return file_exists($path);
        }

        /**
         * check if is valid file depending en extension
         * @return bool
         */
        public abstract function isValid();

        /**
         * return content of file
         * @return mixed
         */
        public abstract function content();


        /**
         * Get $dirname
         *
         * @return  string
         */ 
        public function getDirname()
        {
                return $this->dirname;
        }

        /**
         * Get $filename
         *
         * @return  string
         */ 
        public function getFilename()
        {
                return $this->filename;
        }

        /**
         * Get $basename
         *
         * @return  string
         */ 
        public function getBasename()
        {
                return $this->basename;
        }

        /**
         * Get $extension
         *
         * @return  string
         */ 
        public function getExtension()
        {
                return $this->extension;
        }
}