<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 13/07/2015
 * Time: 20:31
 */

namespace Chicane\Accounts\Contracts;


interface Provider
{
    public function authorize();

    public function login();


}