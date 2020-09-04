<?php

namespace Application\View\Helper;


use Zend\View\Helper\AbstractHelper;

class InstanceOfHelper extends AbstractHelper
{
    function __invoke($instance,$classString)
    {
        return $instance instanceof $classString;
    }
}