@extends('base')
@section('content')


<div class="row mb-3">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1>Create Course</h1>
        <hr />
        @isset($error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endisset
        <form method='POST' action="/create-course" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="name" class="form-control" name='name' />
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="5" name="description"></textarea>
            </div>

            <div class='row mb-3'>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name='image' id="image">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="categories">Categories</label>
                <select class="form-control" id="category" name='category'>
                    <option>Choose</option>
                    @isset($categories)
                    @foreach($categories as $category)
                    <option>{{$category['categoryName']}}</option>
                    @endforeach
                    @endisset
                </select>
                <a href="/create-category" class="btn btn-link">+ Create New Category</a>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="checkbox" class="custom-control-input" id="is_home" name="is_home">
                    <label class="custom-control-label" for="is_home">Is Home</label>
                </div>
                <div class="col">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active">
                    <label class="custom-control-label" for="is_active">Is Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-danger mt-3">Create</button>
        </form>
    </div>
</div>


@endsection
