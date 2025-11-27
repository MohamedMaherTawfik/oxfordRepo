<?php

namespace app\Repository;

use App\Events\NewDataEvent;
use App\Interfaces\CourseInterface;
use App\Models\Courses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class CourseRepository implements CourseInterface
{
    public function allCourses()
    {
        return Courses::with('category', 'user')->get();
    }

    public function allCoursesPaginated()
    {
        return Courses::paginate(10);
    }

    public function newCourses()
    {
        return Courses::all()->reverse()->take(3);
    }

    public function getCourse($id)
    {
        $data = Courses::with('lessons')->find($id);
        return $data;
    }

    public function getCourseBySlug($slug)
    {
        return Courses::with(['lessons', 'user.courses', 'category'])->where('slug', $slug)->first();
    }
    public function createCourse($data)
    {
        $data = Courses::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'categorey_id' => $data['category_id'],
            'duration' => $data['duration'],
            'start_date' => $data['start_date'],
            'slug' => str_replace(' ', '-', strtolower($data['title'])) . time(),
            'cover_photo' => $data['cover_photo']->store('courses', 'public'),
            'level' => $data['level'],
            'user_id' => Auth::user()->id
        ]);
        return $data;
    }

    public function createCourseApi($data)
    {
        $course = Courses::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'categorey_id' => $data['category_id'],
            'duration' => $data['duration'],
            'start_date' => $data['start_date'],
            'slug' => str_replace(' ', '-', strtolower($data['title'])) . time(),
            'cover_photo' => $data['cover_photo']->store('courses', 'public'),
            'level' => $data['level'],
            'user_id' => Auth::guard('api')->user()->id
        ]);
        return $course;
    }

    public function updateCourse($id, $data)
    {
        $data = Courses::find($id)->update($data);
        return $data;
    }

    public function updateCourseApi($id, $data)
    {
        $data = Courses::find($id)->update($data);
        return $data;
    }

    public function deleteCourse($id)
    {
        $data = Courses::findOrFail($id);
        $data->delete();
        return $data;
    }
}
