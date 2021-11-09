@extends('admin.main')

@section('content')
    <form action="{{ url('/admin/sliders/add') }}" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Url</label>
                        <input type="text" name="url" value="{{ old('url') }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Image of product</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="upload">
                    <label class="custom-file-label" for="customFile">Upload your file</label>
                </div>

{{--                <input type="file"  class="form-control" id="upload">--}}
                <div class="mx-0 my-2" id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>


            <div class="form-group">
                <label for="menu">Sort</label>
                <input type="number" name="sort_by" value="1" class="form-control" >
            </div>

            <div class="form-group">
                <label>Status</label>
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
            <button type="submit" class="btn btn-primary">Add slider</button>
        </div>
        @csrf
    </form>
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
