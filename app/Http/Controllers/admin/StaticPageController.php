<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
     public function edit($id)
    {
        $page = StaticPage::findOrFail($id);
        return view('admin.static_pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|max:255',
            'content_en' => 'required',
            'title_ar' => 'required|max:255',
            'content_ar' => 'required',
        ]);

        $page = StaticPage::findOrFail($id);
        $page->update($request->all());

        return redirect()->route('admin.static_pages.edit', $page->id)
                         ->with('success', 'Page updated successfully');
    }
}
