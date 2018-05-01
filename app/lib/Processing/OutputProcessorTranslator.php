<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 19/05/2015
 * Time: 11:29
 */

namespace Chicane\Processing;


/**
 * Class ProcessorTranslator
 * @package Chicane\Processing
 */
class OutputProcessorTranslator {

    /**
     * @param $object
     * @return string
     * @throws \Exception
     */
    public function toDataTransformer($object)
    {
        $objectClass = get_class($object);
        $class = "Chicane\\Processing\\DataMappers\\". $objectClass. "\\". $objectClass . "DataMapper";

        if ( !class_exists($class) ) {

            $message = "Command handler [$class] does not exists";
            throw new \Exception($message);
        }

        return $class;
    }


}