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
    /*
    protected $title="";
    protected $subtitle="";
    protected $text="";
    protected $slug="";*/


    public function model()
    {
        $model = parent::model();

        $model[]="title";
        $model[]="subtitle";
        $model[]="text";
        $model[]="slug";

        return $model;
    }

    public function rules()
    {
        return [

            ['NotEmpty','title',[],'cantBeEmpty'],
            ['MatchesLength','title',[5,120],'lengthBetween:5,120']


        ];
    }

    /**
     * Makes slug from title (friendly url)
     */
    function makeSlug()
    {
        var_dump($this);
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