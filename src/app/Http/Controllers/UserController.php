<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $blogs = Blog::with('user')->where('user_id', $user->id)->get();
        return view('users.detail', [
            'user' => $user,
            'blogs' => $blogs
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($request->only('name', 'email'));

        return redirect()->route('users.show', $user)->with('status', 'Your profile has been updated.');
    }


    /**
     * Destroy user.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if (Auth::id() !== $user->id) {
            return redirect()->back();
        }

        Auth::guard('web')->logout();

        $user->delete();

        return redirect('/')->with('status', 'Your account has been deleted.');
    }
}
