@extends('admin.main')

@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection


@section('content')

    <!-- form start -->
    <form action="" method="post">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="menu-name">Name</label>
                <input type="text" class="form-control" name="name" id="menu-name" placeholder="Enter menu name">
            </div>
            <div class="form-group">
                <label for="parent">Menus</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Parent menu</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" placeholder="Enter description"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" placeholder="Enter content"></textarea>
            </div>
            <div class="form-group">
                <label for="">Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked>
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="inactive" name="active">
                    <label for="inactive" class="custom-control-label">No</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create menu</button>
        </div>
    </form>

@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content')
    </script>
@endsection
