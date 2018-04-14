<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.04.18
 * Time: 22:35
 */

namespace app\forms;

use yii\base\Model;

class ToUserForm extends Model
{
    public $recipient_sum;
    public $recipient_id;
    
    public function rules(){
        return [
            [['recipient_sum'],'number'],
            [['recipient_id'],'integer']
        ];
    }

}