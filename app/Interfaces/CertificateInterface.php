<?php

namespace App\Interfaces;

interface CertificateInterface
{
    public function storeCertificate($data);
    public function deleteCertificate($id);
}