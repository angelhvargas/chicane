<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 08/05/2015
 * Time: 12:21
 */
namespace Chicane\Commanding;

interface CommandBus{

    public function execute($command);
}