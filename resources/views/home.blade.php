@extends('base')

@section('content')

<style>
    .jumbotron {
        background-image: url("{{asset('image/bg.jpg')}}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>

<div class="jumbotron jumbotron-fluid" style="height: 340px;">
    <div class="container">

        <h1 class="display-4 " style="color: #2F4F4F;">Course App</h1>

        <div class="row">
            <div class="col-md-2">
                <p class="lead mt-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis, neque?</p>
            </div>
        </div>

    </div>
</div>
<div class="container mt-4">

    <div class="row">
        @if(count($courses)>0)
        @foreach($courses as $course)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="/image/{{$course['imageUrl']}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$course['courseName'] }}</h5>
                    <a href="/courses/{{$course['slug']}}" class="btn btn-primary">İncele</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="alert alert-danger">
            NO COURSE
        </div>
        @endif
    </div>

</div>

@endsection
