<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 13/07/2015
 * Time: 20:28
 */

namespace Chicane\Accounts\Providers;


abstract class Provider
{

    abstract protected function getAuthorizationUrl();

}