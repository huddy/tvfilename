<?php
namespace tvfilename;
use tvfilename\handlers;

class tvfilenamefailureresult {
    
    public $string = '';
    public $status = false;
    
    public function __construct($string){
        $this->string = $string;
    }
}

?>
