<?php

return [
    //MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
	// AdminController
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
	'admin/add' => [
		'controller' => 'admin',
		'action' => 'add',
	],

    'admin/table' => [
        'controller' => 'admin',
        'action' => 'table'
    ],

    'admin/users' => [
        'controller' => 'admin',
        'action' => 'users'
    ],

    'admin/users/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'users',
    ],

    'admin/update/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'update'
    ],

    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete'
    ],

    'admin/request' => [
        'controller' => 'admin',
        'action' => 'request',
    ],

    'admin/request/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'request',
    ],

    'admin/addrequest/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'addrequest',
    ],

    'admin/reject/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'reject',
    ],

    // AccountController

    'account/register' => [
        'controller' => 'account',
        'action' => 'register'
    ],

    'account/confirm/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'confirm',
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login'
    ],

    'account/profile' => [
        'controller' => 'account',
        'action' => 'profile'
    ],

    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout'
    ],

    'account/recovery' => [
        'controller' => 'account',
        'action' => 'recovery',
    ],

    'account/reset/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'reset',
    ],

    //DashboardController


    'dashboard/list' => [
        'controller' => 'dashboard',
        'action' => 'list'
    ],

    'dashboard/list/{page:\d+}' => [
        'controller' => 'dashboard',
        'action' => 'list'
    ],

    'dashboard/request' => [
        'controller' => 'dashboard',
        'action' => 'request'
    ],

];