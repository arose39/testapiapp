@extends('layouts/admin_layout')
@section('title', __('admin.orders.edit_order_page'))
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
    <form action="{{route('orders.update', $order->id)}}" method="post">
        @method("patch")
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="user">User</label>
                <select name="user_id" class="custom-select mr-sm-2" name="group" id="user">
                    @foreach($users as $user)
                        <option value="{{$user->id}}" @if($order->user == $user) selected @endif>
                            id:{{$user->id}}  name:{{$user->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="product">Product</label>
                <select name="product_id" class="custom-select mr-sm-2" name="product" id="group">
                    @foreach($products as $product)
                        <option value="{{$product->id}}" @if($order->product == $product) selected @endif>
                            id:{{$product->id}}  {{$product->name}}  price:{{$product->price}}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{__('admin.orders.submit')}}</button>
        </div>
    </form>
@endsection
