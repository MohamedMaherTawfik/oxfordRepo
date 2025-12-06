<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Diplomas;
use App\Models\DiplomasCategorey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class diplomaController extends Controller
{
    public function index()
    {
        $diplomas = Diplomas::with('categorey', 'user')->orderBy('created_at', 'desc')->get();
        $requests = \App\Models\RequestCertificate::orderBy('created_at', 'desc')->get();
        return view('admin.diplomas.index', compact('diplomas', 'requests'));
    }

    public function create()
    {
        $categories = DiplomasCategorey::all();
        return view('admin.diplomas.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'diplomas_categorey_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
            'duration' => 'required|numeric',
            'start_date' => 'required|date',
        ]);

        $validated['slug'] = Str::slug($request->name) . '-' . time();
        $validated['user_id'] = auth()->id();
        $validated['image'] = $request->image->store('diplomas', 'public');
        Diplomas::create([
            'name' => $validated['name'],
            'diplomas_categorey_id' => $validated['diplomas_categorey_id'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $validated['image'],
            'slug' => $validated['slug'],
            'user_id' => $validated['user_id'],
            'duration' => $validated['duration'],
            'start_date' => $validated['start_date'],
        ]);

        return redirect()->route('diplomas.index')->with('success', 'Diploma Created Successfully!');
    }

    public function edit(Diplomas $diploma)
    {
        $categories = DiplomasCategorey::all();
        return view('admin.diplomas.edit', compact('diploma', 'categories'));
    }

    public function update(Request $request, Diplomas $diploma)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'diplomas_categorey_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'duration' => 'required|numeric',
            'start_date' => 'required|date',
        ]);

        if ($request->name != $diploma->name) {
            $validated['slug'] = Str::slug($request->name) . '-' . time();
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($diploma->image && \Storage::disk('public')->exists($diploma->image)) {
                \Storage::disk('public')->delete($diploma->image);
            }
            $validated['image'] = $request->image->store('diplomas', 'public');
        }

        $diploma->update($validated);

        return redirect()->route('diplomas.index')->with('success', 'Diploma Updated Successfully!');
    }

    public function delete(Diplomas $diploma)
    {
        $diploma->delete();
        return back()->with('success', 'Diploma Deleted Successfully!');
    }


}
