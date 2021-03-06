@extends('admin.main')

@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <form action="{{ route('admin.product.edit.update', ['product' => $product->id]) }}" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Product name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                               placeholder="Enter product name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Menu</label>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ $product->menu_id == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Original price</label>
                        <input type="number" name="price" value="{{ $product->price }}"  class="form-control" step="0.01" min="0">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Sale price</label>
                        <input type="number" name="price_sale" value="{{ $product->price_sale }}"  class="form-control" step="0.01" min="0">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Description </label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Details</label>
                <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Product image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="upload">
                    <label class="custom-file-label" for="customFile">Upload your file</label>
                </div>

{{--                <input type="file"  class="form-control" id="upload">--}}
                <div class="mx-0 my-2" id="image_show">
                    <a href="{{ url('/').$product->thumb }}" target="_blank">
                        <img src="{{ url('/').$product->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $product->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                <label>Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $product->active == 1 ? ' checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $product->active == 0 ? ' checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update product</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            const uploadUrl = "{{ route('admin.upload.services') }}";
            $("#upload").change(function() {
                const form = new FormData();
                form.append('file', $(this)[0].files[0]);

                $.ajax({
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    dataType: 'JSON',
                    data: form,
                    url: uploadUrl
                })
                    .done(function(data, textStatus) {
                        if (data.error === false) {
                            const imageUrl = "{{ url('/') }}" + data.url;
                            const imageLinkHtml = `<a href=${imageUrl} target='_blank'><img src=${imageUrl} width='100px'></a>`;
                            console.log(`Image url full path: `, imageUrl);
                            $("#image_show").html(imageLinkHtml);

                            $("#thumb").val(data.url);
                        } else {
                            alert(`Upload file failed`);
                        }
                    })
                    .fail(function() {})
                    .always(function() {});
            });
        })
    </script>
@endsection
