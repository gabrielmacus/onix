<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 06/02/2018
 * Time: 11:01 AM
 */

namespace framework\modules\quickstart\model;

use framework\modules\base\model\Base;
use framework\modules\fileStorage\model\FileStorageDAO;

class QuickstartDAO extends FileStorageDAO
{
    public function __construct()
    {
        parent::__construct(FRAMEWORK_DIR."modules/quickstart/qs.json");
    }

    function Create(Base &$base)
    {
        //Will save only one instance
        $base->_id = "qs";
        return parent::Create($base);
    }
}