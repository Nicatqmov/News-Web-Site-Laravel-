<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        return view('front.layouts.pages.posts');
    }

    public function detail(){
        return view('front.layouts.pages.post-detail');
    }
}
