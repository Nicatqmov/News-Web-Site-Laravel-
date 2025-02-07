<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App\Models\News;
use App\Models\NewsCategory;
class NewsController extends Controller
{
    public function index(){
        $allNews=News::with('category')->get();
        return view('admin.layouts.pages.news.index',compact('allNews'));

    }

    public function create(){
        $categories = NewsCategory::all();
        return view('admin.layouts.pages.news.create',compact('categories'));
    }

    public function store(Request $request){
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';
    
            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;
    
            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);
    
                $imagePath = 'uploads/' . $webpFileName;
            }
        }
    

        $news = News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imagePath,
            'views' => 0,   
            'is_active' => $request->is_active ? 1 : 0,
        ]);
    
        return redirect()->route('news.index');
       
    }

    public function edit($id){
        $news = News::find($id);
        $categories = NewsCategory::all();
        return view('admin.layouts.pages.news.edit',compact('news','categories'));
    }

    public function update(Request $request,$id){
        $news = News::find($id);

        if($news){
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('uploads');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';
        
                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;
        
                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
        
                    $imagePath = 'uploads/' . $webpFileName;
                    $news->image = $imagePath;
                }
            }

            if($request->is_active){
                $is_active = 1;
            }else{
                $is_active = 0;
            }
            $news->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'is_active' => $is_active,
            ]);

            $news->save();

        }
        return redirect()->route('news.index');

    }

    public function destroy($id){
        $news = News::find($id);
        if($news){
            $news->delete();
        }

        return redirect()->route('news.index');
    }
}
