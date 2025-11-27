<?php

namespace App\Interfaces;

interface SubmissionsInterface
{
    public function all($slug);
    public function store($GraduationSlug);
    public function update($slug);
}
