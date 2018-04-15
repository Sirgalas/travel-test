<?php

if ($_SERVER['SERVER_NAME'] == "yiitest.herokuapp.com") {
    $host = 'ec2-54-247-81-88.eu-west-1.compute.amazonaws.com';
    $username = 'mowiefedjjfoju';
    $password = 'd7c9bcd85b6ef99dbed84dbab9446560a0c280000f5f61d3fec075adcac52166';
    $dbname = 'd1scssnm5v561k';
    $nameHost = 'pgsql';
}else{
    $host = 'localhost;';
    $username = 'root';
    $password = '1';
    $dbname = 'test';
    $nameHost = 'mysql';
}
var_dump([
    'class' => 'yii\db\Connection',
    'dsn' => $nameHost.':host='.$host.' dbname='.$dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'enableSchemaCache' => true,

]);
return [
    'class' => 'yii\db\Connection',
    'dsn' => $nameHost.':host='.$host.' dbname='.$dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'enableSchemaCache' => true,
];




