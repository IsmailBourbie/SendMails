<?php

namespace App\Classes;

class Time
{

    /**
     * the time of start doing something
     * @var float
     * @access private
     */
    private $begin;

    /**
     * the time of end doing something
     * @var float
     * @access private
     */
    private $end;


    /**
     * saving the timestamp of the beginig
     */
    public function start()
    {
        $this->begin = microtime(true);
    }
    /**
     * saving the timestamp of the finish
     */
    public function finish()
    {
        $this->end = microtime(true);
    }

    /**
     * calcultaing the time used 
     * @return float
     */
    public function spent_time()
    {
        return $this->end - $this->begin;
    }
}
