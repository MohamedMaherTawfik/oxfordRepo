<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiplomasCategorey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class diplomaCategoreyController extends Controller
{
    public function index()
    {
        $diplomasCategorey = DiplomasCategorey::orderBy('created_at', 'desc')->get();
        return view('admin.diplomaCategorey.index', compact('diplomasCategorey'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $validated['photo'] = $request->photo->store('diploma_categories', 'public');
        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        DiplomasCategorey::create($validated);

        return back()->with('success', 'Category created successfully!');
    }


    public function update(Request $request, DiplomasCategorey $categorey)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old image if exists
            if ($categorey->photo && \Storage::disk('public')->exists($categorey->photo)) {
                \Storage::disk('public')->delete($categorey->photo);
            }
            $validated['photo'] = $request->photo->store('diploma_categories', 'public');
        }

        $validated['slug'] = Str::slug($validated['name']) . '-' . time();

        $categorey->update($validated);

        return back()->with('success', 'Category updated successfully!');
    }


    public function delete(DiplomasCategorey $categorey)
    {

        $categorey->delete();

        return back()->with('success', 'Category deleted successfully!');
    }

}
