<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/02/2018
 * Time: 10:59 AM
 */

namespace framework\modules\user\model;


use framework\modules\base\model\Base;

class User extends Base
{

    function model()
    {
        $model = parent::model();
        $model["username"]="";
        $model["name"]="";
        $model["surname"]="";
        $model["email"]="";

        return $model;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['MatchesExp','username',['/^[a-z\d_-]{5,20}$/i'],'invalidUsername'];
        $rules[] = ['IsEmail','email',[],'invalidEmail'];
        $rules[] = ['MatchesExp','name',['^[a-z\d \']{2,70}$'],'invalidName']; //TODO: improve regex, should accept accents and else
        $rules[] = ['MatchesExp','surname',['^[a-z\d \']{2,70}$'],'invalidSurname']; //TODO: improve regex, should accept accents and else

        return $rules;
    }

    private function sendValidationEmail()
    {
        $email = $this->email;



    }

    static function BeforeCreate(Base &$obj)
    {
        parent::BeforeCreate($obj);

        $obj->sendValidationEmail();
    }
}