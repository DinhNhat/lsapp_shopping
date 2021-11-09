@extends('admin.main')

@section('content')

    <div class="card-body table-responsive p-0">
        <table class="table table-striped text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Update</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($sliders as $key => $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name }}</td>
                    <td>{{ $slider->url }}</td>
                    <td><a href="{{ url('/').$slider->thumb }}" target="_blank">
                            <img src="{{ url('/').$slider->thumb }}" height="40px">
                        </a>
                    </td>
                    <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                    <td>{{ $slider->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ url("/admin/sliders/edit/{$slider->id}") }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $slider->id }}, '{{ url('/admin/sliders/destroy') }}')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    {!! $sliders->links() !!}
@endsection


