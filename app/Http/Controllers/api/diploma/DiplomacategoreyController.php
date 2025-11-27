<?php

namespace App\Http\Controllers\api\diploma;

use App\Http\Controllers\Controller;
use App\Models\Diplomas;
use App\Models\DiplomasCategorey;
use Illuminate\Http\Request;
use App\Http\Controllers\api\student\apiResponse;
use App\Interfaces\CategoryInterface;
use Illuminate\Support\Str;

class DiplomacategoreyController extends Controller
{
    use apiResponse;
    private $categoryRepository;
    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryRepository = $categoryInterface;
    }

    public function allCategories()
    {
        $categories = DiplomasCategorey::all();
        try {
            if (count($categories) == 0) {
                return $this->noContent();
            }
            return $this->success($categories, 'All categories Fetched Successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function coursesPerCategorey()
    {
        $categorey = DiplomasCategorey::find(request('id'));
        if (!$categorey) {
            return $this->notFound('Categorey not found');
        }

        $courses = Diplomas::where('diplomas_categorey_id', $categorey->id)->paginate(10);
        try {
            if (count($courses) == 0) {
                return $this->success($courses, 'No courses found for this categorey');
            }
            return $this->success($courses, 'Courses fetched successfully for this categorey');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function singleCategorey()
    {
        $category = DiplomasCategorey::find(request('id'));
        try {
            if (!$category) {
                return $this->notFound('Categorey not found');
            }
            return $this->success($category, 'categorey Fetched Successfully');
        } catch (\Throwable $th) {
            $this->serverError($th);
        }
    }

    public function createCategory(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|min:1|max:50',
            'photo' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);
        $fields['slug'] = Str::slug($fields['name']);
        if ($request->hasFile('photo')) {
            $fields['photo'] = $request->file('photo')->store('categorey');
        }

        $categorey = DiplomasCategorey::create($fields);
        if (!$categorey) {
            return $this->serverError('not created');
        }
        return $this->success($categorey, 'Categorey Created Successfully');
    }

    public function updateCategory(Request $request)
    {
        $fields = $request->validate([
            'name' => 'nullable|min:1|max:50',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);
        $fields['slug'] = Str::slug($fields['name']);
        if ($request->hasFile('photo')) {
            $fields['photo'] = $request->file('photo')->store('categorey');
        }
        $category = DiplomasCategorey::where('id', request('id'))->first();
        $category->update($fields);
        if (!$category) {
            return $this->serverError('not Updated');
        }
        return $this->success($category, 'Categorey Updated Successfully');
    }

    public function deleteCategory()
    {
        $category = DiplomasCategorey::where('id', request('id'))->delete();
        if (!$category) {
            return $this->serverError('categorey not deleted');
        }
        return $this->noContent();
    }
}
