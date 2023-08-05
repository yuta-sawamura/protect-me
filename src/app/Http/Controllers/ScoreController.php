<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        return view('score-board');
    }
}
