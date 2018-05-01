<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 15/05/2015
 * Time: 15:35
 */

namespace Chicane\Processing;


/**
 * Interface DataProcessor
 * @package Chicane\Processing
 */
interface DataProcessor {

    /**
     * @param $object
     * @return mixed
     */
    public function run($object);

}