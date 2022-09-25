@extends('layouts/admin_layout')
@section('title', __('admin.users.list_of_registered_users'))
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
                <label for="name">{{__('admin.users.name')}}</label>
                <input name="name" type="string" class="form-control" id="name"
                       placeholder="{{__('admin.users.enter_name')}}">
            </div>
            <div class="form-group">
                <label for="email">{{__('admin.users.email')}}</label>
                <input name="email" type="email" class="form-control" id="email"
                       placeholder="{{__('admin.users.enter_email')}}">
            </div>
            <div class="form-group">
                <label for="password">{{__('admin.users.password')}}</label>
                <input name="password" type="string" class="form-control" id="password"
                       placeholder="{{__('admin.users.enter_password')}}">
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{__('admin.users.submit')}}</button>
        </div>
    </form>
@endsection
