<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 06/01/2018
 * Time: 15:01
 */

namespace app\modules\post\model;


use framework\modules\base\model\Base;
use framework\services\UrlService;

class Post extends Base
{



    static function Model()
    {
        $model = Base::Model();

        $model["title"]=["value"=>""];
        $model["subtitle"]=["value"=>""];
        $model["text"]=["value"=>""];
        $model["slug"]=["value"=>""];


        return $model;
    }


    public function rules()
    {
        return [

            ['MatchesLength','subtitle',[15,250,true],'lengthBetween:15,250'],
            ['MatchesLength','title',[5,120],'lengthBetween:5,120']


        ];
    }

    /**
     * Makes slug from title (friendly url)
     */
    function makeSlug()
    {

        $this->slug = (!empty($this->title))?UrlService::UrlSlug($this->title):"";
    }

    static function BeforeCreate(Base &$obj)
    {
        $obj->makeSlug();
        parent::BeforeCreate($obj);
    }

    static function BeforeUpdate(Base &$obj)
    {
        $obj->makeSlug();

        parent::BeforeUpdate($obj);
    }




}