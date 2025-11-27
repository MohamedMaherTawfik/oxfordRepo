<?php

namespace App\Interfaces;

interface CourseInterface
{
    public function allCourses();
    public function allCoursesPaginated();
    public function newCourses();
    public function getCourse($id);
    public function getCourseBySlug($slug);
    public function createCourse($data);
    public function createCourseApi($data);
    public function updateCourse($id, $data);
    public function updateCourseApi($id, $data);
    public function deleteCourse($id);
}