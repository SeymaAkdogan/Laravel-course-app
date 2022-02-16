@extends('base')
@section('content')


<div class="row mb-3">
    @isset($error)
    <div class="alert alert-danger">
        {{$error}}
    </div>
    @endisset
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1>Create Course</h1>
        <hr />
        @isset($error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endisset
        <form method='POST' action="/edit-course/{{$course['slug']}}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="name" class="form-control" name='name' value="{{$course['courseName']}}" />
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="5" name="description">{{$course['description']}}
                </textarea>
            </div>

            <div class='row mb-3'>
                <div class='col'>
                    <label for="image" class="form-label">Image</label>
                    <input type="text" class="form-control" name='image' value="{{$course['imageUrl']}}" />
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="categories">Categories</label>
                <select class="form-control" id="category" name='category'>
                    <option>Choose</option>
                    @isset($categories)
                    @foreach($categories as $category)
                    @if($category['slug'] == $course['category'])
                    <option value="{{$category['categoryName']}}" selected>{{$category['categoryName']}}</option>
                    @else
                    <option value="{{$category['categoryName']}}">{{$category['categoryName']}}</option>
                    @endif
                    @endforeach
                    @endisset
                </select>
            </div>
            <div class="row mb-3">
                <div class="col">
                    @if($course['is_home'] == 0)
                    <input type="checkbox" class="custom-control-input" id="is_home" name="is_home">
                    @else
                    <input type="checkbox" class="custom-control-input" id="is_home" name="is_home" checked>
                    @endif
                    <label class="custom-control-label" for="is_home">Is Home</label>
                </div>
                <div class="col">
                    @if($course['is_active'] == 0)
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active">
                    @else
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked>
                    @endif
                    <label class="custom-control-label" for="is_active">Is Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-danger mt-3">Edit</button>
        </form>
    </div>
</div>


@endsection
