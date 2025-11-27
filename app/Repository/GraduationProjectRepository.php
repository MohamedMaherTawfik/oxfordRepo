<?php

namespace App\Repository;
use App\Interfaces\GraduationProjectInterface;

use App\Models\Courses;
use App\Models\graduationProject;
use Illuminate\Support\Str;


class GraduationProjectRepository implements GraduationProjectInterface
{
    public function createGraduationProject($data, $course_id)
    {
        $data['slug'] = Str::slug($data['title']);
        return graduationProject::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'file' => $data['file'] ?? null,
            'slug' => $data['slug'] . time(),
            'courses_id' => $course_id,
            'teacher_id' => auth()->user()->id,
        ]);
    }

    public function getGraduationProjects($slug)
    {
        $course = Courses::where('slug', $slug)->firstOrFail();
        return graduationProject::where('courses_id', $course->id)->get();
    }

    public function getGraduationProjectBySlug($slug)
    {
        return graduationProject::where('slug', $slug)->with('teacher')->firstOrFail();
    }

    public function updateGraduationProject($id, $data)
    {
        return graduationProject::findOrFail($id)->update($data);
    }

    public function deleteGraduationProject($id)
    {
        $graduationProject = graduationProject::findOrFail($id);
        return $graduationProject->delete();
    }
}