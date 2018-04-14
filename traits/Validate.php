<?php
namespace app\traits;

trait  Validate{
    public function validateAuthKey($authKey) {}
    public static function findIdentityByAccessToken($token, $type = null){}
    public function getAuthKey(){}    
}