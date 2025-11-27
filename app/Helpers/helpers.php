<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return Auth::guard('api')->check() ? Auth::guard('api')->user() : Auth::guard('web')->user();
    }
}

if (!function_exists('sar_symbol')) {
    function sar_symbol()
    {
        return '<img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" alt="SAR" class="inline-block" style="width: 1em; height: 1em; vertical-align: middle;">';
    }
}
