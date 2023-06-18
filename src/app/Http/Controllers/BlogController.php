<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(Request $request): View
    {
        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $blogs = Blog::with('user')
                ->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('content', 'like', '%' . $searchQuery . '%')
                ->get();
        } else {
            $blogs = Blog::with('user')->get();
        }
        return view('blogs.index', ['blogs' => $blogs]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blogs.detail', ['blog' => $blog]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Blog $blog)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Blog $blog)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Blog $blog)
    // {
    //     //
    // }
}
