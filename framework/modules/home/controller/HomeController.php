<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 08/02/2018
 * Time: 03:33 PM
 */

namespace framework\modules\home\controller;


use framework\modules\base\controller\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $data=[];
        $this->sendResponse($data,'home');
    }

    public function create()
    {

        throw new \Exception("actionNotAvailable",404);
    }

    public function update()
    {

        throw new \Exception("actionNotAvailable",404);
    }

    public function delete()
    {

        throw new \Exception("actionNotAvailable",404);
    }


}