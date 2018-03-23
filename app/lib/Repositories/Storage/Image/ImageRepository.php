<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 22/08/2015
 * Time: 01:02
 */

namespace Sil\Repositories\Storage\Image;


/**
 * Interface ImageRepository
 * @package Sil\Repositories\Storage\Image
 */
interface ImageRepository
{
    /**
     * @param array $objects
     * @param $path
     * @param $method
     * @return mixed
     */
    public function create($objects = [], $path, $method);

    /**
     * @param $imageObject
     * @return mixed
     */
    public function delete($imageObject);

}