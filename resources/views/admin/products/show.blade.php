@extends('layouts/admin_layout')
@section('title', __('admin.products.product'))
@section('main_content')
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('admin.products.product')}}</h3>

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
                        <th style="width: 30%">
                            description
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

                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->localizations->where('locale', $locale)->first()->name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->localizations->where('locale', $locale)->first()->description}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->updated_at}}</td>
                            <td class="project-actions text-right">
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

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection
