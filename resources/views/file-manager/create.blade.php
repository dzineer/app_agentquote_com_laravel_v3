@extends('layouts.file-manager-page')

@section('content')

    <script src="{{ asset('js/request.js') }}"></script>

    <script>

        function postWithFileRequest (url, data, in_headers)  {

            // debugger;

            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let headers = {
                'Accept': 'application/json',
                //    'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            };

            let post_headers = Object.assign({}, headers, in_headers);

            return fetch(url,
                {
                    method: "POST",
                    headers: post_headers,
                    credentials: 'same-origin',
                    body: data
                })
        }

        function uploadImage(e) {

            e.preventDefault();

            let data = new FormData();

            let in_headers = {};

/*           in_headers = {
                'Content-Type': 'multipart/form-data'
           };*/

            let input = document.querySelector('input[type="file"]');

            data.append("file",input.files[0]);

            postWithFileRequest(
                '/file-manager',
                data,
                in_headers
            )
                .then(function(res) {
                    return res.json();
                })
                .then(function(data) {
                    console.log(data);
                    if (typeof data.success !== "undefined" && data.success === true) {
                        console.log(data.message);
/*
                        var win = parent.tinymce.activeEditor.windowManager.getParams().window;
                        var field = parent.tinymce.activeEditor.windowManager.getParams().input;
                        var t = parent.tinymce.activeEditor.windowManager.windows;
                        win.document.getElementById(field).value = src;
                        t.find('#src').fire('change');*/
                        window.parent.postMessage({
                            mceAction: 'insertContent',
                            value: data.url
                        }, '*');

                        window.parent.postMessage({
                            name: 'close'
                        }, '*');

                    } else {
                        console.log(data.message)
                    }
                })
                .catch(function(error) {
                    console.log(error)
                });

        }
    </script>

    <div class="ml-2 col-sm-6">
        <div id="msg"></div>
        <form method="post" id="image-form">
            <input type="file" id="file" name="file" class="file" accept="image/*">
            <a class="btn btn-primary" id="file-upload-btn" href="#" >Upload</a>
        </form>
    </div>

    <script>
        document.getElementById('file-upload-btn').onclick = uploadImage;
    </script>

@stop
