@extends('layouts/admin_layout')
@section('title', 'Создание нового пользователя')
@section('main_content')
    @if(session('success'))
        <div class="alert alert-danger">
        <h1>{{session('success')}}</h1>
        </div>
        @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="{{route('users.store')}}" method="post">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input name="name" type="string" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="string" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
