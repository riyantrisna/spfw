<?php
//error_reporting('E_ALL & ~E_NOTICE'); //comment to show error and notice

/*config for base direktory and url*/
$application['docroot'] = SPFW_APP_DIR;
$application['basedir'] = BASE_DIR;
$application['baseaddress'] = BASE_ADDRESS;

/*config 0 for connect to database*/
$application['db_connect'][0]['db_host'] = 'localhost';
$application['db_connect'][0]['db_username'] = 'root';
$application['db_connect'][0]['db_password'] = 'mysql';
$application['db_connect'][0]['db_name'] = 'spfw';
$application['db_connect'][0]['db_port'] = '3306';

/*config 0 for email*/
$application['email'][0]['status'] = true;
$application['email'][0]['host'] = 'mx1.idhostinger.com';
$application['email'][0]['smtpauth'] = true;
$application['email'][0]['username'] = 'noreply@vanillaleather.com';
$application['email'][0]['password'] = 'noreply';
$application['email'][0]['namelable'] = 'Vanilla Leather';
$application['email'][0]['smtpsecure'] = 'tls';
$application['email'][0]['port'] = 587;


date_default_timezone_set('Asia/Jakarta');
