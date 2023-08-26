<?php 

$config['permissions'] = [
    'ADMIN' => [
        'defaultRoute' => 'utilisateur',
        'permittedRoutes' => ['utilisateur', 'employe']
    ],
    'USER' => [
        'defaultRoute' => 'employe',
        'permittedRoutes' => ['employe'],
    ],
];