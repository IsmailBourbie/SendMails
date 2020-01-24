<?php

namespace App\Classes;

abstract class File
{

        /**
         * dirname of file
         * @var string $dirname
         * @access protected
         */
        protected $validExtensions;

        /**
         * path of file
         * @var string $filepath
         * @access protected
         */
        protected $filepath = NULL;

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
                if ($this->isExists($file)) {
                        $file_parts = pathinfo($file);
                        $this->dirname = $file_parts['dirname'];
                        $this->basename = $file_parts['basename'];
                        $this->filename = $file_parts['filename'];
                        $this->extension = $file_parts['extension'];
                        $this->filepath =  $this->dirname . '/' . $this->basename;
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
        public function isValid()
        {
                return in_array($this->extension, $this->validExtension);
        }
        
        /**
         * get valid extensions
         * @return array 
         */
        public function getValidExtension()
        {
                return $this->validExtension;
        }


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

        /**
         * Get $filepath
         *
         * @return  string
         */ 
        public function getFilepath()
        {
                return $this->filepath;
        }
}
