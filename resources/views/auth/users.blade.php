@extends('base')
@section('content')


<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Is Admin</th>
        </tr>
    </thead>
    <tbody>
        @isset($users)
        @foreach($users as $user)
        <tr>
            <td>{{$user->firstname}} {{$user->lastname}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if($user->role == 'admin')
                <input type="checkbox" class="form-check-input" id="is_admin" checked>
                @else
                <input type="checkbox" class="form-check-input" id="is_admin">
                @endif
            </td>
        </tr>
        @endforeach
        @endisset

    </tbody>
</table>

@endsection
