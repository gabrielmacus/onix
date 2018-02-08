<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/02/2018
 * Time: 11:00 AM
 */

namespace framework\modules\user\controller;


use framework\modules\base\controller\BaseController;

use framework\modules\user\model\User;
use framework\modules\user\model\UserDAO;
use framework\services\ArrayService;
use PHPMailer\PHPMailer\Exception;

class UserController extends BaseController
{

    /**
     * Confirms the user registration
     * @throws Exception
     */
    function confirmation()
    {


        $code = (empty($_GET["code"]))?false:$_GET["code"];

        if(!$code)
        {
            throw new Exception($this->lang->i18n("missingConfirmationCode"),400);
        }

        /**
         * @var UserDAO $dao
         */
        $dao = ArrayService::First($this->daoArray);

        /**
         * @var User $user
         */
        $user = ArrayService::First($dao->Read(["validation_code"=>$code]));


        if(!$user)
        {
            throw new Exception($this->lang->i18n("userNotExistsOrConfirmed"));
        }

        unset($user["password"]);

        $user->validation_code  = false;
        $user->status = USER_ACTIVE;


        $dao->Update($user);

        $this->sendResponse(["confirmationText"=>$this->lang->i18n("confirmationText"),"message"=>$this->lang->i18n("userConfirmed:{$user->username}")],"confirmed");
    }

}