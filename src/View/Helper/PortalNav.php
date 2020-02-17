<?php

namespace ConnectedSites\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Application;
use Omeka\Api\Manager as ApiManager;

class PortalNav extends AbstractHelper
{   
    protected $sites = [];

    public function __invoke($sites=[])
    {         
        return $sites;
    }

}