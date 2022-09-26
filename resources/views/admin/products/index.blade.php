@extends('layouts/admin_layout')
@section('title', __('admin.products.list_of_products'))
@section('main_content')
    @if(session('success'))
        <div class="alert alert-danger">
            <h1>{{session('success')}}</h1>
        </div>
    @endif
    <a class="btn btn-block btn-info btn-lg" href="{{route('products.create')}}">
        {{__('admin.products.add_new_product')}}
    </a>
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('admin.products.list_of_products')}}</h3>

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
                            localized name
                        </th>
                        <th style="width: 20%">
                            privat name
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            created_at
                        </th>
                        <th>
                            updated_at
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->localizations->where('locale', $locale)->first()->name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->updated_at}}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{route('products.show', $product->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Show
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route('products.edit', $product->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form action="{{route('products.destroy', $product->id)}}" method="POST">
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
