<?php

namespace Application\View\Helper;


use Zend\View\Helper\AbstractHelper;

class GetClassHelper extends AbstractHelper
{
    function __invoke($instance)
    {
        return get_class($instance);
    }
}