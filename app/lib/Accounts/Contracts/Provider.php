<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 13/07/2015
 * Time: 20:31
 */

namespace Sil\Accounts\Contracts;


interface Provider
{
    public function authorize();

    public function login();


}