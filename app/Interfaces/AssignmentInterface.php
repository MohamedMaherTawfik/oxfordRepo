<?php

namespace App\Interfaces;

interface AssignmentInterface
{
    public function allAssignment($id);
    public function getAssignment($id);
    public function createAssignment(array $data,$id);
    public function updateAssignment(array $data,$id);
    public function deleteAssignment($id);
}
