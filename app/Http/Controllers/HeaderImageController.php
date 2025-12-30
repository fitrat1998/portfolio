<?php

namespace App\Http\Controllers;

use App\Models\HeaderImage;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        $headerImages = HeaderImage::all();
        // dd($headerImages);
        return view('admin.headerimages.index', compact('headerImages', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pages = Page::all();

        return view('admin.headerimages.add', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'header_image' => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $path = $request->file('header_image')
            ->store('header_images', 'public');


        HeaderImage::create([
            'page_id' => $validated['page_id'],
            'header_image' => $path,
        ]);


        return redirect()->route('headerimages.index')
            ->with('toast', [
                'type' => 'success', // success, error, info, warning
                'message' => 'Header Image muvaffaqiyatli saqlandi'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(HeaderImage $headerImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeaderImage $headerimage)
    {
        $pages = Page::all();

        return view('admin.headerimages.edit', compact('headerimage', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeaderImage $headerImage)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'header_image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('header_image')) {
            if ($headerImage->header_image && Storage::disk('public')->exists($headerImage->header_image)) {
                Storage::disk('public')->delete($headerImage->header_image);
            }

            $path = $request->file('header_image')
                ->store('header_images', 'public');

            $headerImage->header_image = $path;
        }

        $headerImage->page_id = $validated['page_id'];
        $headerImage->save();


        return redirect()->route('headerimages.index')
            ->with('toast', [
                'type' => 'success', // success, error, info, warning
                'message' => 'Header Image muvaffaqiyatli yangilandi'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeaderImage $headerImage, $id)
    {
        $headerImage = HeaderImage::find($id);
        if ($headerImage->header_image && Storage::disk('public')->exists($headerImage->header_image)) {
            Storage::disk('public')->delete($headerImage->header_image);
        }

        $headerImage->delete();

        return redirect()->route('headerimages.index')
            ->with('toast', [
                'type' => 'success',
                'message' => 'Header Image muvaffaqiyatli o\'chirildi'
            ]);
    }
}
