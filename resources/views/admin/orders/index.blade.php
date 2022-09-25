@extends('layouts/admin_layout')
@section('title', __('admin.orders.list_of_orders'))
@section('main_content')
    @if(session('success'))
        <div class="alert alert-danger">
            <h1>{{session('success')}}</h1>
        </div>
    @endif
    <a class="btn btn-block btn-info btn-lg" href="{{route('orders.create')}}">
        {{__('admin.orders.add_new_order')}}
    </a>
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">orders</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            id
                        </th>
                        <th style="width: 20%">
                            product
                        </th>
                        <th style="width: 30%">
                            price
                        </th>
                        <th>
                            created_at
                        </th>
                        <th>
                            updated_at
                        </th>
                        <th>
                            user
                        </th>
                        <th style="width: 8%" class="text-center">
                            user id
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->product->price}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->updated_at}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->user->id}}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{route('orders.edit', $order->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form action="{{route('orders.destroy', $order->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection
