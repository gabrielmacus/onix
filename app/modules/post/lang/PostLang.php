<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 12/01/2018
 * Time: 15:26
 */

namespace app\modules\post\lang;


use framework\modules\base\lang\BaseLang;

class PostLang extends BaseLang
{


    public function loadLang()
    {

        parent::loadLang();

        /**
         * Español
         */
        $this->langArray["es"]["title"] = "Título";

        $this->langArray["es"]["subtitle"] = "Bajada";

        $this->langArray["es"]["text"] = "Texto";

        $this->langArray["es"]["slug"] = "Url amigable";


        return $this->langArray;
    }

}