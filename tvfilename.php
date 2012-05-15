<?php

/**
 * Library to take a file name and attempt to get the season and episode number. 
 */

namespace tvfilename;

use tvfilename\handlers;

class tvFilename
{

    private $_handlers = array();

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

            if (true == $handler->match($string)) {
                require_once 'tvfilenameresult.php';
                return new tvfilenameresult($handler);
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

        if (empty($this->_handlers)) {
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
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(realpath(__DIR__ . '/handlers')));
        foreach ($iterator as $file) {
            if (!preg_match('/(handler.php|handlerinterface.php)/i', $file->getFilename(), $matches) > 0) {
                require_once($file->getPathname());
                $handlerName = preg_replace('/\.php/', '', $file->getFilename());
                $class = '\\tvfilename\\handlers\\' . $handlerName;
                //$class = "\\tvfilename\\handlers\\format1";
                $handler = new $class;
                $this->addHandler($handlerName, $handler);
            }
        }

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

/**class Episode {

    protected $_filePath;
    protected $_showName;
    protected $_season;
    protected $_episode;

    public function __construct($filePath) {
        
    }

}**/