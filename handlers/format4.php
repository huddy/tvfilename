<?php

namespace tvfilename\handlers;

require_once 'handlerInterface.php';

class format4 implements handlerInterface {

    public $episode;
    public $season;
    public $string;
    private $_regex = '/\D+(\d)(\d\d)\D+/i'; //matches stargate.atlantis.409.dsr.xvid.notv.avi - we assume season is first single digit.;

    public function match($string) {
        $matches = array();
        if (preg_match($this->_regex, $string, $matches) > 0) {
            $this->season = $matches[1];
            $this->episode = $matches[2];
            $this->string = $string;
            return true;
        }
    }

}