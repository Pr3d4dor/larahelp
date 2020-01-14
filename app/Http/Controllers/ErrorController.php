<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->is('admin/*') && $request->user()) {
            return view('admin.errors.404');
        }

        return view('errors.404');
    }
}
