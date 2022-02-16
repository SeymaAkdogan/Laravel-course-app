@extends('base')
@section('content')


<div class="row">
    <div class="col-md-3">
        @include('partials.categories')
    </div>
    <div class="col-md-9">
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
</div>

@endsection
