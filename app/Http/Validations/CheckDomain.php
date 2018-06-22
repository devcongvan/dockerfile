<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/21/2018
 * Time: 12:38 AM
 */

namespace App\Http\Validations;

use App\Http\Validations\CustomValidationInterface;

class CheckDomain implements CustomValidationInterface
{
    public function name(){
        return 'is_domain';
    }

    public function test(){
        return function ($_,$value){
            if (strpos($value, '.') !== false) {
                return true;
            }
            return false;
        };
    }

    public function errorMessage(){
        return 'Bạn phải nhập tên miền .com, .vn, ...';
    }
}