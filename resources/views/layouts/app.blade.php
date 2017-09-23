<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Ajax calls can be modified to more dynamic implementation using function and calling by arguments.
        var contents;
        $('#saveBtn').on('click', function() {
            var formData = $('#productForm').serialize();
            var request = $.ajax({
                url: "{{ url('products') }}",
                method: "POST",
                data: formData,
                dataType: "json"
            });
            request.done(function (response) {
                var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto product" data-id="'+ response.dateTime +'">' +
                        '<div class="row pb-4">' +
                        '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 field" contenteditable="true">' + response.name + '</div>' +
                        '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 field" contenteditable="true">' + response.quantity + '</div>' +
                        '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 field" contenteditable="true">' + response.price + '</div>' +
                        '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">' +
                        '<button class="btn btn-danger d-inline deleteBtn" data-id="'+ response.dateTime +'">Delete</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                $('.products').append(html);
            });
            request.fail(function (jqXHR, message) {
                console.log(message);
            });
        });

        $(document).on('click', '.deleteBtn', function() {
            var id = $(this).attr('data-id');
            var request = $.ajax({
                url: "{{ url('products') }}/" + id,
                method: "DELETE",
                dataType: "text"
            });
            request.done(function (response) {
                $('.product[data-id='+ id +']').remove();
            });
            request.fail(function () {

            });
        });

        $(document).on('click', '.field', function(e) {
            e.stopPropagation();
            e.stopImmediatePropagation();
            contents = $(this).html();
            return false;
        });

        $(document).on('blur', '.field', function (e) {
            e.stopPropagation();
            e.stopImmediatePropagation();
            if (contents != $(this).html()){
                var fieldName = $(this).data('name');
                var id = $(this).data('id');
                var value = $(this).text();

                var request = $.ajax({
                    url: "{{ url('products') }}/" + id,
                    method: "PUT",
                    dataType: "json",
                    data: {
                        [fieldName]: value
                    }
                });
                request.done(function (response) {

                });
                request.fail(function () {

                });
            }


            return false;
        });

    });
</script>
</body>
</html>