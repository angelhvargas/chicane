<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 15/05/2015
 * Time: 17:17
 */

namespace Chicane\Processing\DataMappers;


/**
 * Interface DataMapperInterface
 * @package Chicane\Processing\DataMappers
 */
interface DataMapperInterface {

    /**
     * @param $object
     * @return mixed
     */
    public function process($object);

    /**
     * @return mixed
     */
    public function toAjax();

    /**
     * @return mixed
     */
    public function toBlade();

    /**
     * @return mixed
     */
    public function toXML();


}