<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 15/05/2015
 * Time: 15:35
 */

namespace Sil\Processing;


/**
 * Interface DataProcessor
 * @package Sil\Processing
 */
interface DataProcessor {

    /**
     * @param $object
     * @return mixed
     */
    public function run($object);

}