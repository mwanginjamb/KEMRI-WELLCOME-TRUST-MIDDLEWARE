<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    'NavisionUsername'=> 'kwtrp\svc-hrmcn01', //'jkipkurgat',
    'NavisionPassword'=> 'Admin@123', //'Pa55P0rt%',
    'AdPrefix' => 'kwtrp\\',

    'server'=>'144.91.82.244',//'app-svr-dev.rbss.com',//Navision Server
    'WebServicePort'=>'1247',//Nav server Port
    'ServerInstance'=>'KEMRI',//Nav Server Instance
    'CompanyName'=>'KEMRI',//Nav Company,
    'DBCompanyName' => 'KEMRI$', //NAV DB PREFIX

    'codeUnits' => [],

    'ServiceName'=>[
    	 /**************************Leave *************************************/

        'LeaveCard' => 'LeaveCard', //50011
        'LeaveList' => 'LeaveList', //50013
        'LeaveTypesSetup' => 'LeaveTypesSetup', // 50024
        'LeaveBalances' => 'LeaveBalances',//50041
        'LeaveRecallList' => 'LeaveRecallList', // 50065
        'LeaveRecallCard' => 'LeaveRecallCard', // 50064
        'LeaveAttachments' => 'LeaveAttachments', //50031
        'UserSetup' => 'UserSetup', //119
    ],

    'MapActions' => [
        'list',
        'leave',
        'auth',
        'employee',
    ],

    'LeaveCsrfBlock' => [
        'index',
        'employees',
        'create',
        'update',
        'view',
        'auth',
    ],

    'UnAuthorized' => [
        'index',
        'list',
    ],



];
