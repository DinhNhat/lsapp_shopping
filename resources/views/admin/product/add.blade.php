@extends('admin.main')

@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <form action="{{ url('/admin/products/add') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Product name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Enter product name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Menus</label>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Original price</label>
                        <input type="number" name="price" value="{{ old('price') }}"  class="form-control" step="0.01" min="0">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Sale price</label>
                        <input type="number" name="price_sale" value="{{ old('price_sale') }}"  class="form-control" step="0.01" min="0">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Description </label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Details</label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Product image</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

            <div class="form-group">
                <label>Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add product</button>
        </div>
    </form>
@endsection

@section('footer')
    <script type="text/javascript">
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
