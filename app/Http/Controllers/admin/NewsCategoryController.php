<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
class NewsCategoryController extends Controller
{
    public function index(){
        $categories=NewsCategory::all();
        return view('admin.layouts.pages.news-category.index',compact('categories'));
    }

    public function create(){
        return view('admin.layouts.pages.news-category.create');
    }

    public function store(Request $request){

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

        NewsCategory::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('news-category.index');
    }

    public function edit($id){
        $category = NewsCategory::find($id);
        if($category){
            return view('admin.layouts.pages.news-category.edit',compact('category'));
        }
        return redirect()->back();
    }

    public function update(Request $request,$id){
        $category = NewsCategory::findorfail($id);

        if($category){
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
                    $category->image = $imagePath;
                }
            }


            $category->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);


            $category->save();
        }

        return redirect()->route('news-category.index');
    }

    public function destroy($id){
        $category = NewsCategory::find($id);
        if($category){
            $category->delete();
        }
        return redirect()->route('news-category.index');
    }
}
