<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/02/2018
 * Time: 10:59 AM
 */

namespace framework\modules\user\model;


use framework\modules\base\exception\ValidationException;
use framework\modules\base\model\Base;
use framework\modules\permission\model\PermissionDAO;
use framework\services\EmailService;
use framework\services\LanguageService;
use framework\services\ModuleService;
use framework\services\RouteService;
use framework\services\UrlService;

class User extends Base
{

    static function Model()
    {
        $model = parent::Model();
        $model["username"]= ["value"=>""];
        $model["name"]= ["value"=>""];
        $model["surname"]= ["value"=>""];
        $model["email"]= ["value"=>""];
        $model["superadmin"] = ["value"=>false,"component"=>"select","attributes"=>["options"=>[1=>"yes",0=>"no"]]];
        $model["validation_code"]=["value"=>false,"printable"=>false];

        //Loads permissions to select
        $pDao = new PermissionDAO();
        $permissions = $pDao->Read([]);


        $model["permission"] = ["value"=>"","component"=>"select","attributes"=>["options"=>$permissions,"vIf"=>"!model.superadmin || model.superadmin == false"]];

        if(count($permissions) == 0)
        {
            $model["permission"]["printable"] = false;
        }

        return $model;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['MatchesExp','username',['^[a-zA-Z\d_-]{5,20}$'],'invalidUsername'];
        $rules[] = ['IsEmail','email',[],'invalidEmail'];
        $rules[] = ['MatchesExp','name',['^[a-zA-Z\d \']{2,70}$'],'invalidName']; //TODO: improve regex, should accept accents and else
        $rules[] = ['MatchesExp','surname',['^[a-zA-Z\d \']{2,70}$'],'invalidSurname']; //TODO: improve regex, should accept accents and else


        if(empty(self::Model()["permission"]["printable"]))
        {
            //If there aren't permissions, user must be set to superadmin
            $rules[] = ['Equals','superadmin',[true],'shouldBeSuperadmin'];
        }



        return $rules;
    }
    public function validate()
    {
        //If the user is superadmin, permissions aren't set
        if(!empty($this["superadmin"]))
        {
            unset($this["permission"]);
        }

        parent::validate();
    }

    private function sendValidationEmail()
    {
        $config = RouteService::CheckConfiguration(true);

        $LangClass = ModuleService::GetModuleLang($this);

        $lang = new $LangClass(LanguageService::detectLanguage());

        $confirmationLink = UrlService::Join($config["app_url"],"user/confirmation?code={$this->validation_code}");

        if(!EmailService::SendEmail(FRAMEWORK_DIR."/modules/user/view/emails","register-confirmation",["confirmationLink"=>$confirmationLink,"appName"=>$config["app_name"],"user"=>$this,"lang"=>$lang],$lang->i18n("registerConfirmationSubject:{$config["app_name"]}"),[$this->email]))
        {

            throw new ValidationException(json_encode(["email"=>[ ["text"=>$lang->i18n("errorSendingValidationEmail")]   ]]));
        }




    }

    static function BeforeCreate(Base &$obj)
    {

        parent::BeforeCreate($obj);

        //Sets code for user validation
        $obj["validation_code"] = md5(openssl_random_pseudo_bytes(32));

        $obj->sendValidationEmail();
    }


}