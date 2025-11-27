<?php

namespace App\Interfaces;

interface LessonInterface
{
    public function allLessons($id);
    public function getLesson($id);
    public function getLessonBySlug($slug);
    public function createLesson($data, $id);
    public function createLessonApi($data, $id);
    public function updateLesson($data, $id);
    public function deleteLesson($id);
}
