@extends('layouts/admin_layout')
@section('title', __('admin.users.edit_user_page'))
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
    <form action="{{route('users.update', $user->id)}}" method="post">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('admin.users.name')}}</label>
                <input name="name" type="string" value="{{$user->name}}" class="form-control"
                       id="exampleInputEmail1" placeholder="{{__('admin.users.enter_name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('admin.users.email')}}</label>
                <input name="email" type="email" value="{{$user->email}}" class="form-control"
                       id="exampleInputEmail1" placeholder="{{__('admin.users.enter_email')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('admin.users.password')}}</label>
                <input name="password" type="string" value="" class="form-control"
                       id="exampleInputPassword1" placeholder="{{__('admin.users.leave_password_empty')}}">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{__('admin.users.submit')}}</button>
        </div>
    </form>
@endsection
