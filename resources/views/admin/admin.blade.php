@extends('layouts/admin_layout')
@section('title', __('admin.panel.main'))
@section('main_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('admin.panel.main')}}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$numberUsersRegistrations}}</h3>
                            <p>{{__('admin.panel.users_registered')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('users.index')}}" class="small-box-footer">{{__('admin.panel.show_all')}}<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$numberProducts}}</h3>
                            <p>{{__('admin.panel.quantity_of_products')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{route('products.index')}}" class="small-box-footer">{{__('admin.panel.show_all')}}<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$numberOrders}}</h3>

                            <p>{{__('admin.panel.quantity_of_orders')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('orders.index')}}" class="small-box-footer">{{__('admin.panel.show_all')}}<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                <!-- ./col -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
