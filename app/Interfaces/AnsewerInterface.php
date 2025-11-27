<?php

namespace App\interfaces;

interface AnsewerInterface
{
    public function allAnsewer($id);
    public function getAnsewer($id);
    public function createAnsewer(array $data,$id);
    public function updateAnsewer(array $data,$id);
    public function deleteAnsewer($id);
}
