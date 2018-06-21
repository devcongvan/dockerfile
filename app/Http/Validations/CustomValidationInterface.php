<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/21/2018
 * Time: 12:37 AM
 */

namespace App\Http\Validations;


interface CustomValidationInterface
{
    public function name();

    public function test();

    public function errorMessage();
}