<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\footerRequest;
use App\Models\footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function footers()
    {
        $footers = footer::all();
        return view('admin.footer.index', compact('footers'));
    }

    public function createFooter()
    {
        return view('admin.footer.create');
    }

    public function storeFooter(footerRequest $request)
    {
        $data = $request->validated();
        footer::create($data);
        return redirect()->back()->with('success', 'تم إضافة الفوتر بنجاح');
    }

    public function editFooter()
    {
        $footer = footer::first();
        return view('admin.footer.edit', compact('footer'));
    }

    public function updateFooter()
    {
        $data = request()->except('_token');
        $footer = footer::findOrFail(1);
        $footer->update($data);
        return redirect()->route('admin.footers')->with('success', 'تم تعديل الفوتر بنجاح');
    }
}
