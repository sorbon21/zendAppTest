<?php

namespace Application\View\Helper;


use Zend\View\Helper\AbstractHelper;
use ZendTwig\View\TwigModel;

class TwigNavigation extends AbstractHelper
{
    function __invoke()
    {
        $model = new TwigModel();
        $model->setTemplate('navigation/default.twig');
        return $model;
    }
}