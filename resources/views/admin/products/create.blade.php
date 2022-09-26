@extends('layouts/admin_layout')
@section('title', __('admin.products.new_product_page'))
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
    <form action="{{route('products.store')}}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name"> {{__('admin.products.private_name')}}</label>
                <input name="name" type="string" class="form-control" id="name"
                       placeholder="{{__('admin.products.private_name')}}">
                <label for="price"> {{__('admin.products.price')}}</label>
                <input name="price" type="string" class="form-control" id="price"
                       placeholder="{{__('admin.products.price')}}">
            </div>
            <label for="ua_localization"><h3>{{__('admin.products.ua_localization')}}</h3></label>
            <div class="form-group" id="ua_localization">
                <label for="ua_name">{{__('admin.products.ua_product_name')}} </label>
                <input name="localizations[ua][name]" type="string" class="form-control" id="ua_name"
                       placeholder="{{__('admin.products.ua_product_name')}}">
                <label for="ua_description">{{__('admin.products.ua_product_description')}}</label>
                <input name="localizations[ua][description]" type="text" class="form-control" id="ua_description"
                       placeholder="{{__('admin.products.ua_product_description')}}">
            </div>
            <label for="en_localization"><h3>{{__('admin.products.en_localization')}}</h3></label>
            <div class="form-group" id="en_localization">
                <label for="en_name">{{__('admin.products.en_product_name')}} </label>
                <input name="localizations[en][name]" type="string" class="form-control" id="en_name"
                       placeholder="{{__('admin.products.en_product_name')}}">
                <label for="en_description">{{__('admin.products.ena_product_description')}}</label>
                <input name="localizations[en][description]" type="text" class="form-control" id="en_description"
                       placeholder="{{__('admin.products.en_product_description')}}">
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{__('admin.products.submit')}}</button>
        </div>
    </form>
@endsection
