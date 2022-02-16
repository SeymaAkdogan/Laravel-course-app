@extends('base')
@section('content')



<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="/image/{{$course['imageUrl']}}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$course['courseName'] }}</h5>
                <p class="card-text">{{$course['description'] }}</p>

            </div>
        </div>
    </div>
</div>
@auth
@if(Auth::user()->role == 'admin')
<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2" class="fixed-bottom">
        <a href="/edit-course/{{$course['slug'] }}" class="btn btn-danger">Edit</a>
    </div>
</div>
@endif
@endauth

@endsection
