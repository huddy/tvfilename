<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format4 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    private $_regex = '/.*(?<!s\d\d)ep?([0-9]{1,2})/i'; //EPXX OR EXX case insenstive. We assume here there's only one season.;

    public function match($string) {
        $matches = array();
        if (preg_match($this->_regex, $string, $matches) > 0) {
            $this->season = (int) 1;
            $this->episode = (int) $matches[1];
            $this->string = $string;
            return true;
        }
        
        return false;
    }

}