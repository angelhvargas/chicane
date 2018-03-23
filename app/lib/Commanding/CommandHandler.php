<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 12:52
 */

namespace Sil\Commanding;


/**
 * Interface CommandHandler
 * @package Sil\Commanding
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