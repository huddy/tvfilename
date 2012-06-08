<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format8 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    private $_regex = '/^[0-9]*?\D+?[_ \.]([0-9]{0,3})[_ \.\[\]].*\[.+\]/i';
    //[DBNL] One Piece - 079 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv
    public function match($string) {
        $matches = array();
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