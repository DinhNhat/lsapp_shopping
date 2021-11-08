@extends('admin.main')

@section('content')
    <form action="{{ route('admin.sliders.update', ['slider' => $slider]) }}" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Name</label>
                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Url</label>
                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Image of product</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ url('/').$slider->thumb }}">
                        <img src="{{ url('/').$slider->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $slider->thumb }}" id="thumb">
            </div>


            <div class="form-group">
                <label for="menu">Sort</label>
                <input type="number" name="sort_by" value="{{ $slider->sort_by }}" class="form-control" >
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $slider->active == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $slider->active == 0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Slider</button>
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
