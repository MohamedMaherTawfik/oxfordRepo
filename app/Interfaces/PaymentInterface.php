<?php

namespace App\Interfaces;

interface PaymentInterface
{
    public function pay($enrollment);
    public function callBack($request);
}

