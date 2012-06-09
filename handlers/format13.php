<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format13 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    public $episodeType;
    private $_regex = '/\D+s(\d\d)extra(\d\d)/i';
    
    public function match($string) {
        $matches = array();
        //Only match these once we've removed years and/or resolution.
        $string = preg_replace('/19\d\d/','',$string);
        $string = preg_replace('/(\[|\()x264(\]|\))/','',$string);
        if (preg_match($this->_regex, $string, $matches) > 0) {
            
            $this->season = (int) $matches[1];
            $this->episode = (int) $matches[2];
            $this->string = $string;
            $this->episodeType = 'extra';
            return true;
        }
        
        return false;
       
    }

}