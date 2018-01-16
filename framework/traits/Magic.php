<?php
namespace framework\traits;

trait Magic
{

    public function __get( $key )
    {
        return $this->$key;
    }

    public function __set( $key, $value )
    {
        $this->$key = $value;
    }


}