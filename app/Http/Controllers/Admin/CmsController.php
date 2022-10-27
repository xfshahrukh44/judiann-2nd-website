<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class
CmsController extends Controller
{
    public function aboutUs(Request $request)
    {
        if ($request->method() == 'POST') {

        } else {
            return view('admin.cms.about');
        }
    }
}
