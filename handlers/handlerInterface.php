<?php
namespace tvfilename\handlers;

/**
 * Interface to esnure every handler has a method to parse the file name! 
 */

interface handlerInterface {
    public function match($string);
}

?>
