<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/22/2018
 * Time: 11:33 AM
 */

namespace App\Http\Validations;
use App\Http\Validations\CustomValidationInterface;

class CheckSpecialCharacter implements CustomValidationInterface
{
    public function name()
    {
        return 'special_character';
        // TODO: Implement name() method.
    }

    public function test()
    {

        // TODO: Implement test() method.
    }

    public function errorMessage()
    {
        return 'Bạn nhập các ký tự không cho phép';
        // TODO: Implement errorMessage() method.
    }
}