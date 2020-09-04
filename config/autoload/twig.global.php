<?php
return [
    'zend_twig' => [
        'suffix' => 'twig',
        'force_twig_strategy' => true,
        'helpers' => [
            'configs' => [
                \Application\View\TwigHelper::class
            ]
        ],
        'environment' => [
            'debug' => true,
           // 'cache' => __DIR__ . '/../../data/cache/twig',
        ]
    ],
];