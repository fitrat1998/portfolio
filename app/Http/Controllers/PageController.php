<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pages = Page::orderBy('id', 'desc')->get();
        $pages = Page::all();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
        ]);

        Page::create([
            'page_name' => $validated['page_name'],
        ]);

        return redirect()
            ->route('pages.index')
            ->with('success', 'Sahifa muvaffaqiyatli qo‘shildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {

        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
        ]);

        $page->update([
            'page_name' => $validated['page_name'],
        ]);

        return redirect()
            ->route('pages.index')
            ->with('success', 'Sahifa muvaffaqiyatli yangilandi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()
            ->route('pages.index')
            ->with('success', 'Sahifa muvaffaqiyatli o‘chirildi');
    }
}
