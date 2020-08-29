@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Secret Login
@endsection

@section('content_header')
    <h1>Secret Login</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="usr">Group Name:</label>
                                <input type="text" class="form-control" id="group">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3" value=" {{ $labels['save_button_text'] }} ">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

    </style>



@stop
