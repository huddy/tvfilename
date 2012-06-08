<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format3 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    private $_regex = '/Season\s([0-9]{1,2})\sEpisode\s([0-9]{1,2})/i'; //matches 24 Season 1 Episode 01.avi;

    public function match($string) {
        $matches = array();
        if (preg_match($this->_regex, $string, $matches) > 0) {
            $this->season = (int) $matches[1];
            $this->episode = (int) $matches[2];
            $this->string = $string;
            return true;
        }
        
        return false;
    }

}