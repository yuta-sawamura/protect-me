<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $user = User::findOrFail($id);
        $blogs = Blog::with('user')->where('user_id', $id)->get();
        return view('users.detail', [
            'user' => $user,
            'blogs' => $blogs
        ]);
    }
}
