<?php

namespace app\services;

use app\forms\ToUserForm;
use app\entities\Balance;

class BalanceService
{
    public function ToUser(ToUserForm $toUserForm,int $id):void
    {
        $balance=Balance::findOne($id);
        $balance->balanceToUser($toUserForm->recipient_id,$toUserForm->recipient_sum);
    }
}