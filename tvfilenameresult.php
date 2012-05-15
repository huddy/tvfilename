<?php
namespace tvfilename;
use tvfilename\handlers;

class tvfilenameresult {
    
    public $season = '';
    public $episode = '';
    public $string = '';
    public $status = true;
    
    public function __construct(handlers\handlerInterface $handler){
        $this->season = $handler->season;
        $this->episode = $handler->episode;
        $this->string = $handler->string;
    }
}

?>
