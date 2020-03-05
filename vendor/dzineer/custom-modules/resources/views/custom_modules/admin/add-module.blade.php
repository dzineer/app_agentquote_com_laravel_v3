@extends('adminlte::page')

@section('title')
    Custom Modules
@endsection

@section('content_header')
    <h1>Add Modules</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="heading-info">Add Modules</h5>

            <div class="row m-40 p-40" style="/*background-color:#E8E9EC;*/">

                <div id="dropzone">
                    <form action="/modules/add" method="post" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                        @CSRF
                        <div class="dz-message needsclick">
                            Drop files here or click to upload.<br>
                            <span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

    <script src="/vendor/dropzonejs/js/dropzone.js"></script>
    <script>
        jQuery(function() {
           jQuery('div#dropzone').dropzone({
               url: '/modules/add'
           });
        });
    </script>

    <style>
        #dropzone {
            margin-bottom: 3rem;
            margin: 0 auto;
            font-size: 1.3rem;
        }

        .dropzone.dz-clickable {
            cursor: pointer;
        }

        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }

        .dropzone {
            min-height: 150px;
            /*border: 2px solid rgba(0, 0, 0, 0.3);*/
            background: white;
            padding: 54px 54px;
        }
        .dropzone, .dropzone * {
            box-sizing: border-box;
        }

        .dropzone .dz-message .note {
            font-size: 0.8em;
            font-weight: 200;
            display: block;
            margin-top: 1.4rem;
        }
        .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
            cursor: pointer;
        }

        .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
            cursor: pointer;
        }
        .dropzone .dz-message {
            font-weight: 400;
        }
        .dropzone .dz-message {
            text-align: center;
            margin: 2em 0;
        }

    </style>

@stop