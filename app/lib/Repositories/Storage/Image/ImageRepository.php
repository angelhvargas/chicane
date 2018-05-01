<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 22/08/2015
 * Time: 01:02
 */

namespace Chicane\Repositories\Storage\Image;


/**
 * Interface ImageRepository
 * @package Chicane\Repositories\Storage\Image
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