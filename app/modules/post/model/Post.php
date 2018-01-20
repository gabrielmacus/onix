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
    protected $title="";
    protected $subtitle="";
    protected $text="";
    protected $slug="";

    public function rules()
    {
        return [

            ['IsUrl','title',[true],'invalidUrl']

        ];
    }

    /**
     * Makes slug from title (friendly url)
     */
    function makeSlug()
    {
        $this->slug = (!empty($this->title))?UrlService::UrlSlug($this->title):"";
    }

    function beforeCreate()
    {
        $this->makeSlug();

        parent::beforeCreate();
    }

    function beforeUpdate()
    {
        $this->makeSlug();

        parent::beforeUpdate();
    }


}