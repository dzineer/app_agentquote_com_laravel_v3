@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Affiliates</h1>
@stop

@section('run_in_header')

@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">


                    <div id="users-table" class="users-table">

                        <form method="POST" action="/super.super/user/login">

                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="exampleInputEmail1">User</label>
                                <input class="form-control" type="text" id="search" name="search" placeholder="Search for User" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">User</label>
                                <select name="user" id="users-select">
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['id'] . ' - ' . $user['name'] . ' - ' . $user['email'] }}</option>
                                    @endforeach
                                </select>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Login As User</button>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .center-text {
            text-align: center;
        }
    </style>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script>
        jQuery(function($) {
            var $search = $('#search');
            var $usersSelect = $('#users-select');
            var $usersSelectOptions = $('#users-select option');

            $search.keyup(function(e) {
                debugger;
                $usersSelectOptions.each(function(i) {
                    if ($(this).text().search($search.val()) !== -1) {
                        $usersSelect.val($(this).val());
                    }
                })
            });

        }(jQuery));
    </script>
@stop
