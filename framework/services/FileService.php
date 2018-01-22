<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 21/01/2018
 * Time: 12:40
 */

namespace framework\services;


class FileService
{

    /**
     * Saves data into a file
     * @param $filePath string Path of the file where data will be stored
     * @param $data string Data to be saved
     * @param bool $append Sets if the $data should be appended to an existing file or overwritten
     * @throws \Exception
     */
    static function SaveData( $filePath, $data, $append = false)
    {

        /*
        if(!file_exists($filePath) )
        {

                throw new \Exception("fileNotFound",404);


        }*/


        if(!empty($append))
        {
            file_put_contents($filePath,$data,FILE_APPEND);

        }
        else
        {
            file_put_contents($filePath,$data);
        }

    }

    /**
     * Deletes a file
     * @param $filePath string Path where is stored the file to be deleted
     * @return bool If deletion was successful or not
     */
    static function DeleteFile($filePath)
    {

       return unlink($filePath);

    }

    /**
     * Reads data from a file
     * @param $filePath string Path of the file that will be read
     * @param $json boolean Sets if data should be converted to json
     * @return string
     * @throws \Exception
     */
    static function ReadFile($filePath,$json=false){
        if(!file_exists($filePath))
        {
            throw new \Exception("fileNotFound",404);
        }

        $data  = ($json)?json_decode(file_get_contents($filePath),true):file_get_contents($filePath);

        return $data;
    }
}