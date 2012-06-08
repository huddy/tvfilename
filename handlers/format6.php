<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format6 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    private $_regex = '/^[0-9]*?\D+?[_ \.]([0-9]{0,2})[_ \.]\D+/i'; //matches astroboy.1980s.02.the.birth.of.astro.boy-dvdrip.xvid.avi - we assume season is 1
    public function match($string) {
        $matches = array();
        $string = preg_replace('/19\d\d/','',$string);
        if (preg_match($this->_regex, $string, $matches) > 0) {
            
            $this->season = (int) 1;
            $this->episode = (int) $matches[1];
            $this->string = $string;
            return true;
        }
        
        return false;
       
    }

}