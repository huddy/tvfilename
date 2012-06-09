<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format11 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    private $_regex = '/\D+([0-9]{1,3})v2\D+/i';
    
    public function match($string) {
        $matches = array();
        //Only match these once we've removed years and/or resolution.
        $string = preg_replace('/19\d\d/','',$string);
        $string = preg_replace('/\[x264\]/','',$string);
        if (preg_match($this->_regex, $string, $matches) > 0) {
            
            $this->season = (int) 1;
            $this->episode = (int) $matches[1];
            $this->string = $string;
            return true;
        }
        
        return false;
       
    }

}