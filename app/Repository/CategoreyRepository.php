<?php


namespace App\Repository;


use App\Interfaces\CategoryInterface;
use App\Models\categories;

class CategoreyRepository implements CategoryInterface
{
    public function getAllCategories()
    {
        return categories::all();
    }

    public function getCategoryById($id)
    {
        return categories::with('courses')->findOrFail($id);
    }

    public function createCategory($data)
    {
        return categories::create($data);
    }

    public function updateCategory($id, $data)
    {
        $category = categories::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = categories::findOrFail($id);
        $category->delete();
        return true;
    }

    public function getCategoryBySlug($slug)
    {
        return categories::with('courses')->where('slug', $slug)->firstOrFail();
    }
}