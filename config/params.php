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

    'codeUnits' => [
        'PortalFactory', // 50062
    ],

    'ServiceName'=>[
    	 /**************************Leave *************************************/

        'LeaveCard' => 'LeaveCard', //50011
        'LeaveList' => 'LeaveList', //50013
        'LeaveTypesSetup' => 'LeaveTypesSetup', // 50024
        'LeaveBalances' => 'LeaveBalances',//50041
        'LeaveRecallList' => 'LeaveRecallList', // 50065
        'LeaveRecallCard' => 'LeaveRecallCard', // 50064
        'LeaveAttachments' => 'LeaveAttachments', //50031
        'UserSetup' => 'UserSetup', //119---
        'Employees' => 'Employees',// 5201
        'LeaveTypesSetup' => 'LeaveTypesSetup',

        'PortalFactory' => 'PortalFactory', //code unit 50062
    ],

    'MapActions' => [
        'list',
        'leave',
        'auth',
        'employee',
        'employees',
        'leave-types',
        'leave-card',
        'employee',
        'send-for-approval'
    ],

    'LeaveCsrfBlock' => [
        'index',
        'employees',
        'create',
        'update',
        'view',
        'auth',
        'leave',
        'leave-types',
        'leave-card'
    ],

    'UnAuthorized' => [
        'index',
        'list',
        'leave',
        'auth',
        'employees',
        'leave-types',
        'leave-card',
        'employee',
        'send-for-approval'
    ],



];
