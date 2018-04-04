<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 23/08/2015
 * Time: 01:42
 */

namespace Sil\Processing\InputProcessors\Post;


use Sil\Processing\InputProcessors\InputProcessorInterface;

class PostInput extends AbstractPostInput implements InputProcessorInterface
{


    /**
     * @param array $data
     * @return mixed
     */
    public function process($data = [])
    {
        foreach ($data as $key => $value) {

            if ($key == 'title') {
                //todo

            } else if ($key == 'text')

            }
        }
    }

    /**
     * is triggered when invoking inaccessible methods in a static context.
     *
     * @param $name string
     * @param $arguments array
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public static function __callStatic($name, $arguments)
    {
        $instance = new static;

        return call_user_func(array($instance,$name), $arguments); 
    }

    /**
     * @return mixed
     */
    public function sanitize()
    {
        // TODO: Implement sanitize() method.
    }

    /**
     * @return mixed
     */
    public function inputAttributesToArray()
    {
        // TODO: Implement inputAttributesToArray() method.
    }

    /**
     * @return mixed
     */
    public function inputAttributesToJson()
    {
        // TODO: Implement inputAttributestoJson() method.
    }
}