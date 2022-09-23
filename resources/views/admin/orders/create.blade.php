@extends('layouts/admin_layout')
@section('title', 'Creating new order')
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
<form action="{{route('orders.store')}}" method="post">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="user">User</label>
            <select name="user_id" class="custom-select mr-sm-2" name="group" id="user">
                <option value="" selected>Not assigned</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">id:{{$user->id}}  name:{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product">Product</label>
            <select name="product_id" class="custom-select mr-sm-2" name="product" id="group">
                <option value="" selected>Not assigned</option>
                @foreach($products as $product)
                    <option value="{{$product->id}}">id:{{$product->id}}  {{$product->name}}  price:{{$product->price}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
