<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 12:52
 */

namespace Chicane\Commanding;


/**
 * Interface CommandHandler
 * @package Chicane\Commanding
 */
interface CommandHandler {

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command);

}