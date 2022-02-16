@extends('base')
@section('content')


<div class="row mb-2">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1>Create Category</h1>
        <hr />
        @isset($error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endisset
        <form method='POST' action="/create-category">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="name" class="form-control" name='name' />
            </div>

            <button type="submit" class="btn btn-danger mt-3">Create</button>
        </form>
    </div>
</div>


@endsection
