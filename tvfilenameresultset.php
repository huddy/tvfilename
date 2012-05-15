<?php

namespace tvfilename;

use tvfilename\handlers;

class tvfilenameresultset
{

    public $success = 0;
    public $failed = 0;
    public $total = 0;
    public $results = array();

    public function setResults(array $array)
    {
        $this->results = $array;
    }

    public function setFailures($failures)
    {

        if (!is_int($failures)) {
            throw New \Exception('Setting failures must be an integar.');
        }

        $this->failed = $failures;
    }

    public function setSuccessed($successes)
    {

        if (!is_int($successes)) {
            throw New \Exception('Setting success must be an integar.');
        }

        $this->success = $successes;
    }

    public function setTotal($total)
    {

        if (!is_int($total)) {
            throw New \Exception('Setting totals must be an integar.');
        }

        $this->total = $total;
    }

}