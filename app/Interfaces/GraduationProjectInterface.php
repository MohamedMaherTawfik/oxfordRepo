<?php

namespace App\Interfaces;

interface GraduationProjectInterface
{
    public function createGraduationProject($data, $course_id);
    public function getGraduationProjects($course_slug);
    public function getGraduationProjectBySlug($slug);
    public function updateGraduationProject($id, $data);
    public function deleteGraduationProject($id);
}
