<?php

/**
 * Library to take a file name and attempt to get the season and episode number.
 * It works with a series of handlers, each handler is responsible for a certain
 * set or matches and have their own tests. 
 * 
 * @author Billy Howard
 * @class tvfilename 
 */

namespace tvfilename;
use tvfilename\handlers;

class tvFilename
{

    /**
     * List if our handlers in the order they should be loaded. It's important
     * that the most specific handlers are first so the more greedy or last 
     * resort matches don't match when they shouldn't.
     * 
     * @access private
     * @var array
     */
    private $_handlers = array(
        
        'format12' => '',
        'format8' => '',
        'format1' => '',
        'format2' => '',
        'format3' => '',
        'format4' => '',
        'format5' => '',
        'format7' => '',
        'format6' => '',
        'format9' => '',
        'format11' => '',
        'format10' => '', //should probably stay at the bottom quite unspecific. 
        'loadedStatus' => false,
        
    );

    /**
     * Parse string or strings using $this->match.
     * @param string $data
     * @param array $data
     * @return object
     * @return array
     */
    public function parse($data)
    {

        if (!is_array($data)) {
            return $this->match($data);
        }

        $results = array();
        $total = count($data);
        $success = 0;
        $failure = 0;

        foreach ($data as $stringToMatch) {

            $result = $this->match($stringToMatch);

            switch (get_class($result)) {

                case 'tvfilename\tvfilenamefailureresult':
                    ++$failure;
                    break;
                case 'tvfilename\tvfilenameresult':
                    ++$success;
                    break;
            }

            $results[] = $result;
        }

        require_once('tvfilenameresultset.php');
        $resultSet = new tvfilenameresultset;
        $resultSet->setResults($results);
        $resultSet->setFailures($failure);
        $resultSet->setTotal($total);
        $resultSet->setSuccessed($success);

        return $resultSet;
    }

    /**
     * For a given string we ask each handler to see if it can find a match, If 
     * it can then then we return the handler. 
     * 
     * @param string $string
     * @return \tvfilename\tvfilenameresult
     * @throws \Exception 
     */
    public function match($string)
    {
        
        if (!is_string($string)) {
            throw New \Exception('Match only excepts a string, sorry.');
        }
        
        foreach ($this->getHandlers() as $handlerName => $handler) {
            if('loadedStatus' !== $handlerName){ 
                if (true == $handler->match($string)) {
                    require_once 'tvfilenameresult.php';
                    return new tvfilenameresult($handler);
                }
            }
        }

        require_once 'tvfilenamefailureresult.php';
        return new tvfilenamefailureresult($string);
    }

    /**
     * Get handlers from property, we load the handlers if they've not yet been
     * loaded.
     * 
     * @return array 
     */
    public function getHandlers()
    {
        
        if (false === $this->_handlers['loadedStatus']) {
            $this->loadHandlers();
        }
        
        return $this->_handlers;
    }

    /**
     * Load handlers
     * @return tvFilename
     */
    protected function loadHandlers()
    {
        
        /**
         * Since I've not used recuriveiterators befoe and to help anyones else the $file variable contains an instance
         * of SplFileInfo). Tis very useful.  
         */
        /*$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(realpath(__DIR__ . '/handlers')));
        foreach ($iterator as $file) {
            if (!preg_match('/(handler.php|handlerinterface.php)/i', $file->getFilename(), $matches) > 0) {
                require_once($file->getPathname());
                $handlerName = preg_replace('/\.php/', '', $file->getFilename());
                $class = '\\tvfilename\\handlers\\' . $handlerName;
                $handler = new $class;
                $this->addHandler($handlerName, $handler);
            }
        }*/
        
        foreach(array_keys($this->_handlers) as $handler){
            if('loadedStatus' !== $handler){               
                require_once(realpath(__DIR__ . "/handlers/{$handler}.php"));
                $class = '\\tvfilename\\handlers\\' . $handler;
                $handlerObj = new $class;
                $this->addHandler($handler, $handlerObj);
            }
            
        }
        
        $this->_handlers['loadedStatus'] = true;
        return $this;
    }

    /**
     * Add a hander to the _handlers property. 
     * @param string $handlerName
     * @param handlers\handlerInterface $handler 
     */
    protected function addHandler($handlerName, handlers\handlerInterface $handler)
    {
        $this->_handlers[$handlerName] = $handler;
    }

}