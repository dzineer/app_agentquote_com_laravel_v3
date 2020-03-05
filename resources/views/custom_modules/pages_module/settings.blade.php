@extends('adminlte::page')

@section('title')
    Custom Modules
@endsection

@section('content_header')
    <h1>Module Config</h1>
@stop

@section('run_in_header')
    <script src="{{ asset('js/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "#code",
            extended_valid_elements : 'page-section[frame-classes|classes|container|section-classes]',
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            // toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            images_upload_url: '/file-manager',
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;

                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.open('POST', '/file-manager');
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            },
            /*file_picker_callback: function (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                let type = 'image' === meta.filetype ? 'Images' : 'Files',
                    url  = editor_config.path_absolute + 'laravel-filemanager?editor=tinymce5&type=' + type;

                tinymce.activeEditor.windowManager.openUrl({
                    url : "/file-manager",
                    title : 'AQ File Manager',
                    width : x * 0.8,
                    height : y * 0.8,
                    onChange: (api, message) => {
                        console.log(message);
                        callback(message.content);
                        api.close();
                    }
                });
            }*/
        };
        tinymce.init(editor_config);
    </script>

    <script>
        // debugger;
        customModule = {!! $customModuleData !!}
        url = "{!! $url !!}";
    </script>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="heading-info">Pages</h5>

            <ul class="list-group">
                @foreach($pages as $page)
                <li class="list-group-item"  style="cursor: pointer"><a href="{{ '/modules?module=pages_module&page_id=' . $page['id'] }}" style="cursor: pointer">{{ ucfirst($page['name']) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

@stop



