<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    'NavisionUsername'=>'HP ELITEBOOK 840 G5',
    'NavisionPassword'=>'@francis123#',
    'AdPrefix' => 'FRANCIS\\',

    'server'=>'francis',//'app-svr-dev.rbss.com',//Navision Server
    'WebServicePort'=>'4047',//Nav server Port
    'ServerInstance'=>'BC140',//Nav Server Instance
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
        'index',
        'leave'
    ],

    'LeaveCsrfBlock' => [
        'index',
        'employees',
        'create',
        'update',
        'view',
        'auth'
    ]



];
