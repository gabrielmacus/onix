<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 24/01/2018
 * Time: 02:40 PM
 */

namespace framework\modules\configuration\model;



use framework\modules\base\exception\ValidationException;
use framework\modules\base\model\Base;
use framework\modules\fileStorage\model\FileStorage;
use framework\services\EmailService;
use framework\services\LanguageService;
use framework\services\ModuleService;
use framework\services\UrlService;

class Configuration extends FileStorage
{
    static function Model()
    {
        $model = parent::Model();


        //TESTING,DEVELOPMENT or PRODUCTION
        $model["env"] =["value"=>"DEVELOPMENT"];

        $model["active"] = ["value"=>false];


        //App parameters
        $model["app_name"]= ["value"=>""];
        $model["app_url"]= ["value"=>UrlService::CurrentUrl()];
        //TODO: set an id for every app that is deployed
        $model["app_id"] = ["value"=>""];

        //Site parameters
        $model["site_name"]= ["value"=>""];
        $model["site_url"] =  ["value"=>""];

        //DB config
        $model["db_name"]=["value"=>""];
        $model["db_user"]=["value"=>""];
        $model["db_pass"]=["value"=>"" , "attributes"=>["type"=>"password"]];
        $model["db_port"]=["value"=>""];
        $model["db_host"]=["value"=>""];

        //Email parameters
        $model["email_host"] = ["value"=>""];
        //$model["email_smtp_auth"]= ["value"=>true];
        //If empty, email smtp auth is false
        $model["email_smtp_secure"]= ["value"=>"tls"];
        $model["email_username"] = ["value"=>""];
        $model["email_address"]= ["value"=>""];
        $model["email_password"]= ["value"=>"" , "attributes"=>["type"=>"password"]];
        $model["email_port"]= ["value"=>587];


        return $model;
    }



    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['InRange','db_port',[1,65535,true] ,"portRangeAllowed:1,65535"];

        $rules[] = ['MatchesExp','app_name',['^[a-zA-Z0-9_. -]{5,30}$'],'appNameNotAllowed'];

        //$rules[] = ["IsUrl",'app_url',[],'invalidUrl'];

        $rules[] = ["MatchesExp",'site_name',['^[a-zA-Z0-9_. -]{5,40}$',true],'siteNameNotAllowed'];

        $rules[] = ["IsUrl",'site_url',[true],'invalidUrl'];



        $rules[] = ["IsIP",'db_host',[],'invalidIp'];

        //$rules[] = ['NotEmpty','db_user',[] ,"shouldntBeEmpty"];

        $rules[] = ['MatchesLength','db_name',[2,100],'lengthBetween:2,100'];



        $rules[] = ["NotEmpty","email_username",[],'shouldntBeEmpty'];

        $rules[] = ["MatchesLength","email_host",[4,100],'lengthBetween:4,100'];

        $rules[] = ['InRange','email_port',[1,65535,true] ,"portRangeAllowed:1,65535"];

        $rules[] = ['MatchesLength','email_password',[1,200] ,"lengthBetween:1,200"];

        $rules[] = ['IsEmail','email_address',[] ,"invalidEmail"];








        return $rules;
    }

    public function validate()
    {
        parent::validate();

        $LangClass = ModuleService::GetModuleLang($this);

        $lang = new $LangClass(LanguageService::detectLanguage());

        if(!EmailService::SendEmail(FRAMEWORK_DIR."/modules/configuration/view/emails","test",["lang"=>$lang,"appName"=>$this["app_name"],],$lang->i18n("testEmail:".$this["app_name"]),[$this["email_address"]],[],false,$this))
        {
            throw new ValidationException("emailNotWorking");
        }

    }


}