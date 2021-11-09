@extends('admin.main')

@section('content')

    <div class="card-body table-responsive p-0">
        <table class="table table-striped menus-table">
            <thead>
                <tr>
                    <th >ID#</th>
                    <th >Name</th>
                    <th >Active</th>
                    <th >Update</th>
                    <th >&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {!! App\Helpers\Helper::menu($menus) !!}
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script>
        $(function() {

            // using vanilla javascript
            {{--const linksHtml = document.querySelectorAll("table tbody tr td a.remove-menu");--}}
            {{--const requestUrl = "{{ route('admin.menu.destroy') }}";--}}
            {{--for(let i = 0; i < linksHtml.length; i++) {--}}
            {{--    // console.log(`This link data index: `, linksHtml[i].getAttribute("data-menu-index"));--}}
            {{--    linksHtml[i].addEventListener("click", function() {--}}
            {{--        const menuId = Number(linksHtml[i].getAttribute("data-menu-index"));--}}
            {{--        removeMenu(menuId, requestUrl);--}}
            {{--    });--}}
            {{--}--}}

            // using jquery
            // const removeLinksHtml = $("table tbody tr td a.remove-menu");
            // removeLinksHtml.on("click", function() {
            //     const menuId = $(this).data("menu-index");
            //     removeMenu(menuId, requestUrl);
            // });

            // function removeMenu(menuId, requestUrl) {
            //     if (confirm('Are you sure to permanently remove this ?')) {
            //         $.ajax({
            //             type: 'DELETE',
            //             dataType: 'JSON',
            //             data: { id: menuId },
            //             url: requestUrl,
            //             success: function(result) {
            //                 if (result.error === false) {
            //                     alert(result.message);
            //                     location.reload();
            //                 } else {
            //                     alert('Failed to delete a menu. Try again');
            //                 }
            //             },
            //             error: function(xhr) {
            //                 console.log(xhr.responseText); // this line will save you tons of hours while debugging
            //                 // do something here because of error
            //             }
            //         });
            //     }
            //
            // }

        })
    </script>
@endsection
