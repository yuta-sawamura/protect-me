<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $blogs = Blog::with('user')
                ->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('content', 'like', '%' . $searchQuery . '%')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $blogs = Blog::with('user')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->user_id = auth()->user()->id;
        $blog->save();

        return redirect()->route('home')->with('status', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blogs.show', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function edit(int $id): View
    {
        $blog = Blog::findOrFail($id);

        // if (Auth::id() !== $blog->user_id) {
        //     abort(403, 'You do not have permission');
        // }

        return view('blogs.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        // if (Auth::id() !== $blog->user_id) {
        //     abort(403, 'You do not have permission');
        // }

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();

        return redirect()->route('blogs.show', $blog)->with('status', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $blog = Blog::findOrFail($id);
        if (Auth::id() !== $blog->user_id) {
            abort(403, 'You do not have permission');
        }

        $blog->delete();

        return redirect()->route('home')->with('status', 'Blog deleted successfully');
    }
}
