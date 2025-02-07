<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
class HomeController extends Controller
{
    public function index(){
        $news = News::where('is_active' ,'=',1)->get();
        $news_categories = NewsCategory::all();
        return view('front.layouts.pages.home',compact('news','news_categories'));
    }
}
