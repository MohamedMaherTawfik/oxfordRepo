<?php

namespace App\Repository;

use App\Interfaces\CertificateInterface;
use App\Models\Certificate;

class CertificateRepository implements CertificateInterface
{
    public function storeCertificate($data)
    {
        $data = Certificate::create([
            'certificate' => $data['certificate'],
            'user_id' => auth()->user()->id
        ]);
    }


    public function deleteCertificate($id)
    {
        $certificate = Certificate::find($id);
        $certificate->delete();
        return $certificate;
    }

}
