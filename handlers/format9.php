<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format9 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    private $_regex = '/\D+(\d\d)(\d\d)\D+/i';
    //south.park.1202.dsr-0tv.avi
    //private $_regex = '.*[_ \.]([0-9]{0,3})[_ \.\[\]].*\[.+\]/i';
    //[DBNL] One Piece - 079 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv
    public function match($string) {
        $matches = array();
        //Only match these once we've removed years and/or resolution.
        $string = preg_replace('/19\d\d/','',$string);
        $string = preg_replace('/\[x264\]/','',$string);
        $string = preg_replace('/1080p/','',$string);
        if (preg_match($this->_regex, $string, $matches) > 0) {
           
            $this->season = (int) $matches[1];
            $this->episode = (int) $matches[2];
            $this->string = $string;
            return true;
        }
        
        return false;
       
    }

}