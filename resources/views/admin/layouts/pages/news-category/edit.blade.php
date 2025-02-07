@extends('admin.layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 mt-3" style="padding: 0 15px;">
    <a href="{{route('news-category.index')}}" class="btn btn-primary"
        style="font-size: 16px; padding: 10px 20px; margin-left: auto;">
        <i class="lni lni-chevron-left"></i> Back
    </a>
</div>
<form action="{{route('news-category.update')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-style mb-30">
        <div class="input-style-1">
            <label>Title</label>
            <input value="{{$category->title}}" name="title" type="text" placeholder="News Title">
        </div>
        <div class="input-style-1">
            <label>Description</label>
            <textarea placeholder="News Description" name="description" rows="5" data-qb-tmp-id="lt-662575"
                spellcheck="false" data-gramm="false">{{$category->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="formFileLg" class="form-label">News Image</label>
            <input name="image" class="form-control form-control-lg" id="formFileLg" type="file">
        </div>
        @if($category->image)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="card-style-2 mb-30">
                <div class="card-image">
                    <img id="newsImage" src="{{asset($category->image)}}" alt="news image">
                </div>
            </div>
        </div>
        @endif
        <button type="submit" class="main-btn active-btn rounded-full btn-hover mt-3">Create</button>
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