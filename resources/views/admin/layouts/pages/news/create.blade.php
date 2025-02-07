@extends('admin.layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 mt-3" style="padding: 0 15px;">
    <a href="{{route('news.index')}}" class="btn btn-primary"
        style="font-size: 16px; padding: 10px 20px; margin-left: auto;">
        <i class="lni lni-chevron-left"></i> Back
    </a>
</div>
<form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-style mb-30">
        <div class="select-style-1">
            <label>Category</label>
            <div class="select-position">
                <select name="category_id">
                    @foreach ($categories as $category )
                    <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="input-style-1">
            <label>Title</label>
            <input value="{{old('title')}}" name="title" type="text" placeholder="News Title">
        </div>
        <div class="input-style-1">
            <label>Description</label>
            <textarea placeholder="News Description" name="description" rows="5" data-qb-tmp-id="lt-662575"
                spellcheck="false" data-gramm="false">{{old('description')}}</textarea>
        </div>
        <div class="input-style-1">
            <label>Date</label>
            <input name="date" type="date" id="date-input">
        </div>
        <div class="mb-3">
            <label for="formFileLg" class="form-label">News Image</label>
            <input name="image" class="form-control form-control-lg" id="formFileLg" type="file">
        </div>
        <div class="form-check form-switch toggle-switch">
            <input class="form-check-input" name="is_active" type="checkbox" id="toggleSwitch2" checked="">
            <label class="form-check-label" for="toggleSwitch2">Show this news</label>
          </div>
        <button type="submit" class="main-btn active-btn rounded-full btn-hover mt-3">Create</button>
    </div>
</form>

@endsection


@section('script')
<script>
    // Get today's date in the format yyyy-mm-dd
    const today = new Date().toISOString().split('T')[0];
    
    // Set the value of the date input to today
    document.getElementById('date-input').value = today;
</script>
@endsection