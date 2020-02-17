<?php
namespace ConnectedSites;
return [
    'view_manager' => [
        // 'template_path_stack' => [
        //     OMEKA_PATH . '/modules/ConnectedSites/view/',
        // ],
        'template_map' => [
            'connected-sites/site/item/browse' => OMEKA_PATH . '/themes/view-from-ginling/view/omeka/site/item/browse.phtml',
            'connected-sites/site/item/search' => OMEKA_PATH . '/themes/view-from-ginling/view/omeka/site/item/search.phtml',
         ],
    ],
    'router' => [
        'routes' => [
            'site' => [
                'options' => [
                    'route' => '/:site-slug',
                ],
                'child_routes' => [
                    'page' => [
                        'options' => [
                            'route' => '/:page-slug',
                            'constraints' => [
                                'page-slug' => '([a-zA-Z0-9_-]+)\b(?<!item|item-set)',
                            ],
                        ],
                    ],
                    'resource' => [
                        'options' => [
                            'route' => '/:controller[/:action]',
                            'defaults' => [
                                '__NAMESPACE__' => 'ConnectedSites\Controller\Site',
                                'controller' => 'Item',
                                'action' => 'browse',
                            ],
                        ],
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'site' => [
                        'child_routes' => [
                            'slug' => [
                                'options' => [
                                    'route' => '/:site-slug',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'ConnectedSites\Controller\Site\Item' => 'ConnectedSites\Controller\Site\ItemController',
        ],
    ],
];
