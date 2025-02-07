@extends('admin.layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 mt-3" style="padding: 0 15px;">
    <a href="{{route('news.index')}}" class="btn btn-primary"
        style="font-size: 16px; padding: 10px 20px; margin-left: auto;">
        <i class="lni lni-chevron-left"></i> Back
    </a>
</div>
<form action="{{route('news.update',$news->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-style mb-30">
        <div class="select-style-1">
            <label>Category</label>
            <div class="select-position">
                <select name="category_id">
                    @foreach ($categories as $category )
                    <option @if ($category->id == $news->category->id)
                        selected
                        @endif value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="input-style-1">
            <label>Title</label>
            <input value="{{$news->title}}" name="title" type="text" placeholder="News Title">
        </div>
        <div class="input-style-1">
            <label>Description</label>
            <textarea placeholder="News Description" name="description" rows="5" data-qb-tmp-id="lt-662575"
                spellcheck="false" data-gramm="false">{{$news->description}}</textarea>
        </div>
        <div class="input-style-1">
            <label>Date</label>
            <input name="date" value="{{$news->date}}" type="date" id="date-input">
        </div>
        <div class="mb-3">
            <label for="formFileLg" class="form-label">News Image</label>
            <input name="image" class="form-control form-control-lg" id="formFileLg" type="file">
        </div>
        @if($news->image)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="card-style-2 mb-30">
                <div class="card-image">
                    <img id="newsImage" src="{{asset($news->image)}}" alt="news image">
                </div>
            </div>
        </div>
        @endif
        <div class="form-check form-switch toggle-switch">
            <input class="form-check-input" name="is_active" type="checkbox" id="toggleSwitch2" @if($news->is_active == 1) checked="1" @endif>
            <label class="form-check-label" for="toggleSwitch2">Show this news</label>
          </div>
        <button type="submit" class="main-btn active-btn rounded-full btn-hover mt-3">Update</button>
    </div>
</form>

@endsection


@section('script')

<script>
    const imageInput = document.getElementById('formFileLg');
    const imageTag = document.getElementById('newsImage');

    imageInput.addEventListener('change', function () {
        const file = this.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imageTag.src = e.target.result; // Set the img tag's src to the file's data URL
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    });
</script>
@endsection