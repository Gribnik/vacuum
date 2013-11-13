<?php

namespace Jira\VacuumBundle\DependencyInjection;

class Requester
{
    protected $_url;

    public function __construct($url)
    {
        $this->_url = $url;
    }

    public function loginRequest($request)
    {
        echo "Requested login to url " . $this->_url;
    }
}