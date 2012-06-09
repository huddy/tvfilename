<?php

namespace tvfilename;

use tvfilename\handlers;

class tvfilenameresult
{

    public $season = 0;
    public $episode = 0;
    public $string = '';
    public $handler = '';
    public $episodeType = 'standard';
    public $status = true;

    public function __construct(handlers\handlerInterface $handler)
    {
        
        if (empty($handler->season) && empty($handler->episode)
                && !is_numeric($handler->season) && !is_numeric($handler->episode)) {
            throw New \Exception('Handler doesnt appear to have an episode and season or they aren\'nt numeric.');
        }

        $this->season = $handler->season;
        $this->episode = $handler->episode;
        $this->string = $handler->string;
        if(!empty($handler->episodeType))
            $this->episodeType = $handler->episodeType;
        $this->handler = end(explode("\\",get_class($handler)));
    }

}

?>
