@extends('admin.main')

@section('content')

    <div class="card-body table-responsive p-0">
        <table class="table table-striped text-nowrap">
            <thead>
                <tr>
                    <th style="">ID</th>
                    <th>Product name</th>
                    <th>Menu</th>
                    <th>Original price</th>
                    <th>Sale price</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th style="">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $key => $product)

                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->price_sale }}</td>
                    <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.product.edit.show', ['product' => $product->id]) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $product->id }}, '{{ url('/admin/products/destroy') }}')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        {!! $products->links() !!}
    </div>
@endsection


