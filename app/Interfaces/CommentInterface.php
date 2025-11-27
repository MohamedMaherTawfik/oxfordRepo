<?php

namespace App\Interfaces;

interface commentInterface
{
    public function getComments($id);
    public function getComment($id);
    public function storeComment($data, $id);
    public function updateComment($data, $id);
    public function deleteComment($id);
}
