<?php

namespace App\Interfaces;

interface EnrollmentInterface
{
    public function index($id);
    public function store($course_id, $price);
}
