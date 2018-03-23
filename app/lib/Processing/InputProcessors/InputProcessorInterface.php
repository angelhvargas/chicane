<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 23/08/2015
 * Time: 01:35
 */

namespace Sil\Processing\InputProcessors;


/**
 * Interface InputProcessorInterface
 * @package Sil\Processing\InputProcessors
 */
interface InputProcessorInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function process($data = []);

    /**
     * @return mixed
     */
    public function sanitize($data);

    /**
     * @return mixed
     */
    public function inputAttributesToArray();

    /**
     * @return mixed
     */
    public function inputAttributesToJson();

}